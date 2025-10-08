<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\Record;
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
        $record= new Record();
        $record->user_id=Session::get('user')->id;
        $record->quiz_id= Session('first_mcq')->quiz_id;
        $record->status=1;
        if($record->save()){
         $firstMcq=Session('first_mcq');
        if(!$firstMcq){
            return back()->with('error','Quiz session expired. Please restart.');
        }
        $quizId=$firstMcq->quiz_id;
        $current_quiz=Session::get('current_quiz');
        if(!$current_quiz){
           $total_mcqs=Mcq::where('quiz_id',$quizId)->count();
           Session::put('current_quiz',[
            'total_mcqs'=>$total_mcqs,
            'current_mcq'=>1,
            'quiz_name'=>$quiz_name,
            'quiz_id'=>$quizId
           ]);
        }
        
        $mcq=Mcq::findOrFail($id);
        return view('user-mcq',compact('mcq','quiz_name'));
        }else{
            return back()->with('error','Unable to start quiz. Please try again.');
        }
        
    }

    public function quiz_submit_next(Request $request){
        $request->validate([
            'option'=>'required|string',
        ]);

        $current_quiz=Session::get('current_quiz');
        $quiz_id=$current_quiz['quiz_id'];
        $current_mcq_number=$current_quiz['current_mcq'];
        $total_mcqs=$current_quiz['total_mcqs'];
        $quiz_name=$current_quiz['quiz_name'];

        $mcq=Mcq::find($request->mcq_id);
        if(!$mcq){
            return back()->with('error','MCQ not found. Please try again.');
        }

        // // Here you can store the user's answer in the database if needed
        // // For example, you might want to create a UserAnswer model and save the answer

        if($current_mcq_number >= $total_mcqs){
            Session::forget('current_quiz');
            Session::forget('first_mcq');
            return redirect()->route('welcome')->with('success','Quiz completed. Thank you for participating!');
        }else{
            $next_mcq_number=$current_mcq_number + 1;
            $next_mcq=Mcq::where('quiz_id',$quiz_id)->skip($next_mcq_number - 1)->first();
            if(!$next_mcq){
                return back()->with('error','Next MCQ not found. Please try again.');
            }
            Session::put('current_quiz.current_mcq',$next_mcq_number);
            return redirect()->route('user.mcq',[$next_mcq->id,$quiz_name]);
        }
    }
}
