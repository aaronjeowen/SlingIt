<?php

namespace App\Http\Controllers;
use Illuminate\Http\Input;
use Illuminate\Http\Request;
use App\Article;


class SearchController extends Controller
{
      public function submit(Request $request){
        // take var from search, check to see if appears in any articles title
        $q = $request->input('search');
        $articles= Article::where("title",'like',"%".$q."%")->get();
        // return articles
        return view('explore')->with('articles',$articles)->with('search',$q);
       }
}
