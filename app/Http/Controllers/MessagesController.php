<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Input;
use Illuminate\Http\File;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Message;
use App\Comment;
use App\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class MessagesController extends Controller
{
    public function submit(Request $request){
      $this->validate($request,[
        'title'=>'required',
      ]);

      $message = new Message;
      $message->user_id =$request->input('userId');
      $message->title =$request->input('title');
      $message->tags =$request->input('tags');
      $check = $request->file('image')->getMimeType();//check to see what file is being uploaded
      $message->texta =$request->input('editordata');

      if (strpos($check ,'text/')!== false) {
        //if file is text based
        $message->fileType ="text";
        $files = $request->file('image');
        $filename= $request->file('image')->getClientOriginalName(); //get file name
        Storage::putFileAs('public', new File($files),$filename); //store file and get its id
      }elseif (strpos($check ,'image/')!== false) {
        //if file is an image
        $message->fileType ="image";
        $files = $request->file('image');
        $filename= $request->file('image')->getClientOriginalName(); //get file name
        Storage::putFileAs('public', new File($files),$filename); //store file and get its id
      }elseif (strpos($check ,'zip')!== false) {
        //if file is an image
        $message->fileType ="zip";
        $files = $request->file('image');
        $filename= $request->file('image')->getClientOriginalName(); //get file name
        Storage::putFileAs('public', new File($files),$filename); //store file and get its id
      }else {
        return "file format not supported  ,$check";
      }
      $message->image=$filename;
      $message->save();
      return redirect('/view') ->with('success','Message Sent');
      //return $request->file('image')->getMimeType();


    //Storage::disk('local')->put('pubic',$files);
    //$filename= $request->file('image')->getClientOriginalName(); //get file name
    //$filename = time().'-'.$request->file('image')->getClientOriginalName();// get filename and rename with time at start

    }


    public function getMessagesProfile(){
      if (Auth::check()) {
        $messages= Message::where('user_id', Auth::user()->id )->get();
        return view('profile')->with('messages',$messages);
      }
      else{
        return redirect('login');
      }
    }

    public function getMessagesView(){
      if (Auth::check()) {
        $messages= Message::all();
        return view('view')->with('messages',$messages);
      }else {
        return redirect('login');
      }
    }

    public function getMessagesPost(Message $post){
      $comments= Comment::where('post_Id', $post->id )->get();
      $user = User::where('id','=',$post->user_id)->first();
      return view('post', compact('post'))->with('comments',$comments)->with('user',$user);
    }
}
