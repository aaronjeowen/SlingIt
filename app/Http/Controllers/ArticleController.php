<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Input;
use Illuminate\Http\File;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Comment;
use App\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleController extends Controller
{
  public function submit(Request $request){
    // function is for a new article

    //validate post request
    $this->validate($request,[
      'title'=>'required|string|max:100',
      'tags'=>'required',
      'code'=>'required_if:tags,==,Code',
      'file'=>'required',
      'description'=>'required',
    ]);

    //make new model
    $article = new Article;
    $article->user_id =$request->input('userId');
    $article->title =$request->input('title');
    $article->tags =$request->input('tags');
    $article->codeType=$request->input('code');
    if ($article->codeType == null) {
      $article->codeType = " ";
    }
    $article->texta =$request->input('description');
    $article->post_Id =str_random(8);
    $check = $request->file('file')->getMimeType();//check to see what file is being uploaded

    if (strpos($check ,'text/')!== false) {
      //if file is text based
      $article->fileType ="text";
      $files = $request->file('file');
      $originalFilename= $request->file('file')->getClientOriginalName(); //get file name
      $filename = $article->post_Id.'_'.$originalFilename;
      Storage::putFileAs('public', new File($files),$filename); //store file and get its id
    }elseif (strpos($check ,'image/')!== false) {
      //if file is an image
      $article->fileType ="image";
      $files = $request->file('file');
      $originalFilename= $request->file('file')->getClientOriginalName(); //get file name
      $filename = $article->post_Id.'_'.$originalFilename;
      Storage::putFileAs('public', new File($files),$filename); //store file and get its id
    }else {
      return "file format not supported  ,$check";
    }
    $article->image=$filename;
    $article->save();
    return redirect('/explore') ->with('success','Post Created');

  }


  public function getArticlesProfile(){
    // get articles for specifc profile
    if (Auth::check()) {
      $article= Article::where('user_id', Auth::user()->id )->get();
      return view('profile')->with('messages',$article);
    }
    else{
      return redirect('login');
    }
  }

  public function getArticlesView(){
    //get all articles for view
      $article= Article::all();
      return view('explore')->with('articles',$article);
  }

  public function getArticlePost( $post){
    // get specific post by id
    $article= Article::where('post_id', $post )->first();
    $comments= Comment::where('post_id', $article->post_id)->get();
    $user = User::where('id','=',$article->user_id)->first();
    return view('post')->with('comments',$comments)->with('user',$user)->with('articles',$article);
  }
}
