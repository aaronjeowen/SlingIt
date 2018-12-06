<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Storage;
class CommentsController extends Controller
{
    public function submit(Request $request){
      $this->validate($request,[
        'comment'=>'required',
      ]);

      $comment = new Comment;
      $comment->user_id =$request->input('userId');
      $comment->post_id =$request->input('postId');
      $comment->user_username =$request->input('username');
      $comment->comment =$request->input('comment');
      $comment->save();

      return redirect()->back();
    }

    public function download(Request $request){
      $path = storage_path("app/public/$request->postId");
      return response()->download($path);

    }


}
