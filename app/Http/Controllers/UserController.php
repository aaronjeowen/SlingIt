<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Auth;
use App\Article;
use Illuminate\Support\Facades\DB;
use App\User;
use App\userEdit;
use Image;
class UserController extends Controller
{
    public function submit(Request $request){
      $user = Auth::user();
     if ($request->hasFile('avatar')) {
          $files = $request->file('avatar');
          $filename= $user->username.'.jpg'; //get file name
          Storage::putFileAs('public/avatars', new File($files),"test.jpg"); //store file and get its id
          $user->avatar ="test.jpg";
          $user->save();
         return redirect('profile');
    }
  }

  public function getUser($id)
  {
      $user = User::where('id','=',$id)->first();
      return $user;
  }

  public function getUserProfile($userprofile){
      $user = User::where('username','=',$userprofile)->first();
       if($user==null){
         return abort(404);
       }
       $articles = Article::where('user_id', $user->id)->get();
       return view('profile')->with('articles',$articles)->with('user',$user);
  }

  public function getProfile(){
    if (Auth::check()) {
      $messages= Message::where('user_id', Auth::user()->id )->get();
      $user ="";
      return view('profile')->with('messages',$messages)->with('user',$user);
    }
    else{
      return redirect('login');
    }
  }

  public function editProfile(Request $request){
    $user = Auth::user();
    if ($request->hasFile('avatar')) {
        $files = $request->file('avatar');//get image
        $this->validate($request,[
          'avatar'=>'image',// check uploaded file is an image, will return an error if false
        ]);

          $extension = $request->file('avatar')->getClientOriginalExtension();
          $filename= $user->username.".".$extension; //make a filename
          $oldFile = $user->avatar; //previous avatar
          if ($oldFile != 'default.jpg') {
            Storage::delete('public/avatars/'.$oldFile);
          }
          Storage::putFileAs('public/avatars', new File($files),$filename); //store file and get its id
          $user->avatar =$filename;
          $user->save();// set new filename and save
        }



    $userprofile = $request->input('user');
    $occupation = $request->input('occupation');
    $description = $request->input('description');
    $twitter = $request->input('twitter');
    $github = $request->input('github');
    $dribbble = $request->input('dribbble');
    $website = $request->input('website');

      if($occupation){
          DB::table('users')
            ->where('username',$userprofile )
            ->update(['occupation' => $occupation]);
          }

      if($description){
          DB::table('users')
            ->where('username',$userprofile )
            ->update(['description' => $description]);
          }

      if($twitter){
        DB::table('users')
          ->where('username',$userprofile )
          ->update(['twitter' => $twitter]);
          }

      if($github){
          DB::table('users')
            ->where('username',$userprofile )
            ->update(['github' => $github]);
          }

      if($dribbble){
          DB::table('users')
            ->where('username',$userprofile )
            ->update(['dribbble' => $dribbble]);
          }

      if($website){
          DB::table('users')
            ->where('username',$userprofile )
            ->update(['website' => $website]);
          }
            return redirect('profile/'.$userprofile);

  }
  }
