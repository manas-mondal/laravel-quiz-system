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
}
