<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $r){

        $validation=$r->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        $admin=Admin::where(['name'=>$r->name,'password'=>$r->password])->first();
        if(!$admin){
            $validation=$r->validate([
                'user'=>'required'
            ],[
                "user.required"=>"User does not exist"
            ]);
        }
        Session::put('admin',$admin);
        return redirect('/dashboard',);
    }
    
    public function dashboard(){
        $admin=Session::get('admin');
        if($admin){
             return view('admin',compact('admin'));
           
        }else{
            return redirect()->route('admin.login');
        }
       
    }
    
    public function categories(){
        $categories = Category::orderBy('created_at', 'desc')->get();
        $admin=Session::get('admin');
        if($admin){
             return view('admin-categories',compact('admin','categories'));
           
        }else{
            return redirect('/admin-login');
        }
    }

    public function logout(){
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

    public function add_category(Request $r){
        $validation=$r->validate([
            'category_name'=>'required|min:3|unique:categories,name'
        ]);
        $admin=Session::get('admin');
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $category=new Category();
        $category->name=$r->category_name;
        $category->creator=$admin->name;
        $category->save();
        return redirect('/admin-categories')->with('success', "Category " . $r->category_name . " added successfully");
    }

    public function delete_category($id){
        $admin=Session::get('admin');
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $category=Category::find($id);
        if($category){
            $category->delete();
            return redirect('/admin-categories')->with('success', "Category " . $category->name . " deleted successfully");
        }else{
            return redirect('/admin-categories')->with('error', "Category not found");
        }
    }

    // public function add_quiz(Request $r){
    //     $admin=Session::get('admin');
    //     $categories = Category::orderBy('created_at', 'desc')->get();
    //     if($admin){
    //         if($r->category_id && $r->quiz_name && !Session::has('quizDetails')){
    //             $validation=$r->validate([
    //                 'quiz_name'=>'required|min:3|unique:quizzes,name',
    //                 'category_id'=>'required|exists:categories,id'
    //             ]);
    //             $quiz=new Quiz();
    //             $quiz->name=$r->quiz_name;
    //             $quiz->category_id=$r->category_id;
    //             if($quiz->save()){
    //                 Session::put('quizDetails',$quiz);
    //                 return view('add-quiz');
    //             }
    //         }
    //          return view('add-quiz',compact('admin','categories'));
    //     }else{
    //         return redirect('/admin-login');
    //     }
    // }
        public function show_add_quiz_form()
    {
        $admin = Session::get('admin');
        $categories = Category::orderBy('created_at', 'desc')->get();
        $totalMcqs = 0;
        if ($admin) {
            if(Session::has('quizDetails')){
                $quizDetails=Session::get('quizDetails');
                $totalMcqs=Mcq::where('quiz_id',$quizDetails->id)->count();
            }
            return view('add-quiz', compact('admin', 'categories', 'totalMcqs'));
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function add_quiz(Request $r)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $validation = $r->validate([
                'quiz_name'   => 'required|min:3|unique:quizzes,name',
                'category_id' => 'required|exists:categories,id'
            ]);
            $quiz = new Quiz();
            $quiz->name = $r->quiz_name;
            $quiz->category_id = $r->category_id;

            if ($quiz->save()) {
                Session::put('quizDetails', $quiz);
                return redirect()->route('admin.quiz.form')
                                ->with('success', 'Quiz Added Successfully!');
            }

        } else {
            return redirect()->route('admin.login');
        }
    }
    
    public function add_mcqs(Request $r){
        $admin=Session::get('admin');
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $quizDetails=Session::get('quizDetails');
        if(!$quizDetails){
            return redirect()->route('admin.quiz.form')->with('error', 'Please add a quiz first.');
        }
        $validation=$r->validate([
            'question'=>'required|min:5',
            'option_a'=>'required|min:1',
            'option_b'=>'required|min:1',
            'option_c'=>'required|min:1',
            'option_d'=>'required|min:1',
            'correct_option'=>'required|in:option_a,option_b,option_c,option_d'
        ]);
        $mcq=new Mcq();
        $mcq->question=$r->question;
        $mcq->option_a=$r->option_a;
        $mcq->option_b=$r->option_b;
        $mcq->option_c=$r->option_c;
        $mcq->option_d=$r->option_d;
        $mcq->correct_option=$r->correct_option;
        $mcq->admin_id=$admin->id;
        $mcq->category_id=$quizDetails->category_id;
        $mcq->quiz_id=$quizDetails->id;
        if($mcq->save()){
            if($r->submit=='add-more'){
                return redirect()->back()->with('success', 'MCQ Added Successfully! Add more MCQs.');
            }else{
                Session::forget('quizDetails');
                return redirect()->route('admin.quiz.form')->with('success', 'MCQ Added Successfully! Quiz creation completed.');
            }
        }
    }

    public function cancel_quiz(){
        $admin=Session::get('admin');
        if(!$admin){
            return redirect()->route('admin.login');
        }
        Session::forget('quizDetails');
        return redirect()->route('admin.quiz.form')->with('success', 'Quiz creation cancelled.');
    }
    public function show_quiz($id){
        $admin=Session::get('admin');
        if(!$admin){
            return redirect()->route('admin.login');
        }
        $mcqs=Mcq::where('quiz_id',$id)->get();
        return view('show-quiz',compact('admin','mcqs'));
    }

}
