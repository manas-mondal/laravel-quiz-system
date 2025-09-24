<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $mcqs=Mcq::where('quiz_id',$id)->get();
        if($mcqs->count()<1){
            return back()->with('error','No MCQs found for this quiz. Please contact admin.');
        }
        Session::put('first_mcq',$mcqs->first());
        return view('start-quiz',compact('quiz_name','mcqs'));
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

    public function user_login_form(){
        return view('user-login');
    }

    public function user_login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $user=User::where('email',$request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'Invalid email or password')
                ->withInput();
        }

        Session::put('user',$user);

        if (Session::has('quiz-url')) {
            $url = Session::pull('quiz-url'); // pull = get + forget
            return redirect($url)->with('success', 'User logged in successfully');
        }

        return redirect()
            ->route('welcome')
            ->with('success', 'User logged in successfully');
        }

    public function user_login_form_quiz(){
        Session::put('quiz-url',url()->previous());
        return view('user-login');  
    }

    public function mcq($id,$quiz_name){
        $firstMcq=Session('first_mcq');
        $quizId=$firstMcq->quiz_id;
        if(!$quizId){
            return back()->with('error','Quiz session expired. Please restart.');
        }
        $total_mcqs=Mcq::where('quiz_id',$quizId)->count();
        Session::put('current_quiz',[
            'total_mcqs'=>$total_mcqs,
            'current_mcq'=>1,
            'quiz_name'=>$quiz_name,
            'quiz_id'=>$quizId
        ]);
        $mcq=Mcq::findOrFail($id);
        return view('user-mcq',compact('mcq','quiz_name'));
    }

    public function quiz_submit_next(Request $request){
        return $request->all();
    }
}
