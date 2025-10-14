<?php

namespace App\Http\Controllers;

use App\Mail\VerifyUserMail;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\McqRecord;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function welcome(Request $request){
        $query=Category::withCount('quizzes');

        if($request->has('search')){
            $search=$request->input('search');
            $query->where('name','like',"%$search%");
        }
        $categories=$query->paginate(5)->appends($request->only('search'));
        return view('welcome',compact('categories'));
    }

    public function quiz_list($id,$category){
        $quizzes=Quiz::withCount('mcqs')->where('category_id',$id)->get();
        return view('user-quiz-list',compact('id','category','quizzes'));
    }

    public function start_quiz($id,$quiz_name){
        $mcqs=Mcq::where('quiz_id',$id)->get();
        if($mcqs->count()<1){
            return back()
            ->with('error','No MCQs found for this quiz. Please contact admin.');
        }
        Session::put('first_mcq',$mcqs->first());
        return view('start-quiz',compact('quiz_name','mcqs'));
    }

    public function signup_form(){
        return view('user-signup');
    }

    public function signup_form_quiz(){
        Session::put('quiz-url',url()->previous());
        return view('user-signup');
    }

    public function signup(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;  // Laravel auto hash for casted attributes in User model
        $user->active=1;        // 1 = not verified
        $user->verification_token= Str::random(64);
        $user->save();

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
            // $user=User::create($request->only('name','email','password'));

        // send verification email 
        Mail::to($user->email)->send(new VerifyUserMail($user));

        // Do not log in until verified
        Session::forget('user');

        return redirect()
               ->route('user.login.form')
               ->with('success', 'Account created successfully! Please check your email to verify your account before logging in.');
    }

    public function user_login_form(){
        return view('user-login');
    }

    public function user_login_form_quiz(){
        Session::put('quiz-url',url()->previous());
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

        if($user->active != 2){  // not verified
            return back()
                ->with('error', 'Please verify your email before logging in.')
                ->withInput();
        }

        Session::put('user',$user);

        // Redirect to previous quiz URL if exists
        if (Session::has('quiz-url')) {
            $url = Session::pull('quiz-url'); // pull = get + forget
            return redirect($url)
            ->with('success', 'User logged in successfully');
        }

        return redirect()
            ->route('welcome')
            ->with('success', 'User logged in successfully');
    }

    public function user_logout(){
        Session::forget('user');
        return redirect()
        ->route('welcome')
        ->with('success','User logged out successfully');
    }

    public function verify_user($token){
        $user=User::where('verification_token',$token)->first();
        if(!$user){
            return redirect()
            ->route('welcome')
            ->with('error','Invalid verification token.');
        }

        if($user->active == 2){
            return redirect()
            ->route('user.login.form')
            ->with('success','Your email is already verified. Please login below.');
        }

        $user->active=2; // mark as verified
        $user->verification_token=null;
        $user->save();

        return redirect()
        ->route('user.login.form')
        ->with('success', 'Your email has been verified. You can now login.');
    }

    public function mcq($id,$quiz_name){
        // Ensure quiz session is active
        $firstMcq = Session::get('first_mcq');
        if (!$firstMcq) {
            return back()->with('error', 'Quiz session expired. Please restart.');
        }

        $quizId = $firstMcq->quiz_id;
        $userId = Session::get('user')->id;

        //If user switched to a different quiz, reset previous quiz session
        if (Session::has('current_quiz') && Session::get('current_quiz.quiz_id') != $quizId) {
            Session::forget('current_quiz');
        }

         /**
         * Record Handling Logic (UPDATED)
         * 1. Check if user already has a record for this quiz.
         * 2. If status = 2 (completed), reset to 1 (active) and delete old answers.
         * 3. If no record, create a new one.
         */

        //Get or create Record for this user and quiz
        $record = Record::where('user_id', $userId)
                        ->where('quiz_id', $quizId)
                        ->latest()
                        ->first();

        if($record){
            if($record->status == 2){
                // Reset status to active again
                $record->status = 1;
                $record->save();
            }
        }else{
            // No record found at all → create new one
             $record = new Record();
             $record->user_id = $userId;
             $record->quiz_id = $quizId;
             $record->status = 1;
             $record->save();
        }               

        //Set current_quiz session if not already set (or reset above)
        if (!Session::has('current_quiz')) {
            $total_mcqs = Mcq::where('quiz_id', $quizId)->count();
            Session::put('current_quiz', [
                'total_mcqs'    => $total_mcqs,
                'current_mcq'   => 1,
                'quiz_name'     => $quiz_name,
                'quiz_id'       => $quizId,
                'record_id'     => $record->id,
            ]);
        }

        // Show the current MCQ (based on session)
        $mcqNumber = Session::get('current_quiz.current_mcq');
        $mcq = Mcq::where('quiz_id', $quizId)
                ->orderBy('id', 'asc')
                ->skip($mcqNumber - 1)
                ->firstOrFail();

        return view('user-mcq', compact('mcq', 'quiz_name'));
               
    }

    public function quiz_submit_next(Request $request){
        // Validate answer
        $request->validate([
            'option'=>'required|string',
        ]);

        $current_quiz=Session::get('current_quiz');
        if (!$current_quiz) {
        return redirect()
        ->route('welcome')
        ->with('error', 'Session expired. Please restart the quiz.');
        }

        $quiz_id=$current_quiz['quiz_id'];
        $current_mcq_number=$current_quiz['current_mcq'];
        $total_mcqs=$current_quiz['total_mcqs'];
        $quiz_name=$current_quiz['quiz_name'];
        $record_id=$current_quiz['record_id'];

        $user_id = Session::get('user')->id;

        // Fetch current MCQ
        $mcq=Mcq::find($request->mcq_id);
        if(!$mcq){
            return back()->with('error','MCQ not found. Please try again.');
        }

        // Check if this MCQ already answered by this user for this quiz record
        $mcq_exist=McqRecord::where('user_id',$user_id)
                            ->where('record_id',$record_id)
                            ->where('mcq_id',$mcq->id)
                            ->first();
        if($mcq_exist){
            // Update existing answer
            $mcq_exist->selected_answer=$request->option;
            $mcq_exist->is_correct=$mcq->correct_option === $request->option ? 1 : 0;
            $mcq_exist->save();
        }else{
            // Create new record
            $mcq_record= new McqRecord();
            $mcq_record->user_id=Session::get('user')->id;
            $mcq_record->record_id=$record_id;
            $mcq_record->mcq_id=$mcq->id;
            $mcq_record->selected_answer=$request->option;
            $mcq_record->is_correct=$mcq->correct_option === $request->option ? 1 : 0;
            $mcq_record->save();
        }
         // If last MCQ, finish the quiz
         if($current_mcq_number >= $total_mcqs){
            Session::forget('current_quiz');
            Session::forget('first_mcq');

            // Update record status to completed
            $record=Record::find($record_id);
            if($record){
                $record->status=2; // completed
                $record->save();
         }
         $resultData = McqRecord::with('mcq')->where('record_id', $record_id)->get();
         $correctAnswers = $resultData->where('is_correct', 1)->count();
         $totalQuestions = $resultData->count();
         return view('quiz-result', compact('resultData','correctAnswers', 'totalQuestions', 'quiz_name'));
        }

        // Identify actual MCQ for current session number
        $expected_mcq_id=Mcq::where('quiz_id',$quiz_id)
                                ->orderBy('id','asc')
                                ->skip($current_mcq_number - 1)
                                ->value('id');

        // Check if user is re-answering an older question
        if($mcq->id != $expected_mcq_id){
            return back()
            ->with('error','Please answer the questions in order.')
            ->withInput();
        }

        // Move to next question
        $next_mcq_number=$current_mcq_number + 1;
        $next_mcq=Mcq::where('quiz_id',$quiz_id)
                         ->orderBy('id','asc')
                         ->skip($next_mcq_number - 1)
                         ->first();
        if(!$next_mcq){
            return back()
            ->with('error','Next MCQ not found. Please try again.');
        }

        // Update session for next question
        Session::put('current_quiz.current_mcq',$next_mcq_number);

        return redirect()
        ->route('user.mcq',[$next_mcq->id,$quiz_name]);
    }

    public function user_details(){
        $user_id = Session::get('user')->id;
        $records = Record::where('user_id', $user_id)
                         ->with('quiz','quiz.category') // Eager load quiz and its category
                         ->withCount([ 
                            'mcq_records as correct_answers' => function($query) {
                                $query->where('is_correct', 1);
                            },
                            'mcq_records as total_questions'
                         ])
                         ->get();

        return view('user-details', compact('records'));     
    }
}
