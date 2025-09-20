<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function signup(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);

        // $user=new User();
        // $user->name=$request->name;
        // $user->email=$request->email;
        // $user->password=$request->password;  // Laravel auto hash for casted attributes in User model
        // $user->save();


        // or use mass assignment
    //     User::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'password' => $request->password, // Laravel auto hash for casted attributes in User model
    // ]);


        // or use fill method
            // $user = new User();
            // $user->fill($request->only('name','email','password')); 
            // $user->save();


        // or use mass assignment with validated data
            $user=User::create($request->only('name','email','password'));

            if($user){
                Session::put('user',$user);
                if(Session::has('quiz-url')){
                    $url=Session::get('quiz-url');
                    Session::forget('quiz-url');
                    return redirect($url)->with('success','User registered successfully');
                }
                return redirect()->route('welcome')->with('success','User registered successfully');
            }
    }

    public function signup_form_quiz(){
        Session::put('quiz-url',url()->previous());
        return view('user-signup');
    }

    public function user_logout(){
        Session::forget('user');
        return redirect()->route('welcome')->with('success','User logged out successfully');
    }
}
