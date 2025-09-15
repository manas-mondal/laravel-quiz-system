<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome(){
        $categories=Category::withCount('quizzes')->get();
        return view('welcome',compact('categories'));
    }

    public function quiz_list($id,$category){
        $quizzes=Quiz::withCount('mcqs')->where('category_id',$id)->get();
        return view('user-quiz-list',compact('id','category','quizzes'));
    }

    public function signup_form(){
        return view('user-signup');
    }

    public function start_quiz($id,$quiz_name){
        $mcqCount=Quiz::find($id)->mcqs->count();
        return view('start-quiz',compact('id','quiz_name','mcqCount'));
    }
}
