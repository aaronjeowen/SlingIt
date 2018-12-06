<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
  // return pages when top level route is searched for
    public function getHome(){
      return view('home');
    }
    public function getView(){
      return view('explore');
    }
    public function getSubmit(){
      if (Auth::check()) {
        return view('submit');
      }
      else {
        return redirect('login');
      }
    }
    public function getProfile(){
      return view('profile');
    }
    public function getWelcome(){
      return view('welcome');
    }
    public function getTest(){
      return view('test');
    }
}
