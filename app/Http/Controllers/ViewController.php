<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\View;
use App\Article;


class ViewController extends Controller{

    public function submit(Request $request ){
      // controller is for explore page filtered posts by type
      // make new model
      $article = new Article;
      $article->viewType =$request->input('View');

      if ($article->viewType != 'All') {
        $articles= Article::where('tags', $article->viewType )->get();
        if ($articles == null) {
          return view('explore')->with('error',"No matches");
        }
        return view('explore')->with('articles',$articles);

      }else {
        $articles= Article::all();
        return view('explore')->with('articles',$articles);
      }
  }
}
