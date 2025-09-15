<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome(){
        $categories=Category::withCount('quizzes')->get();
        return view('welcome',compact('categories'));
    }

    public function quiz_list($id,$category){
        $quizzes=Category::find($id)->quizzes;
        return view('user-quiz-list',compact('id','category','quizzes'));
    }

    public function signup_form(){
        return view('user-signup');
    }
}
