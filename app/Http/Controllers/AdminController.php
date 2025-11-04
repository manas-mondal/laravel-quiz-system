<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\User;
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

        return redirect()
            ->route('dashboard')->with('success', 'Logged in successfully');
    }
    
    public function dashboard(){
        $admin=Session::get('admin');

        $users= User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard',compact('admin','users'));
    }
    
    public function categories(){
        $categories = Category::orderBy('created_at', 'desc')->paginate(8);

        $admin=Session::get('admin');
             return view('admin.categories',compact('admin','categories'));
    }

    public function logout(){
        Session::forget('admin');

        return redirect()
            ->route('admin.login')->with('success', 'Logged out successfully & you can login again');
    }

    public function add_category(Request $r){
        $validation=$r->validate([
            'category_name'=>'required|min:3|unique:categories,name'
        ]);
        $admin=Session::get('admin');
        $category=new Category();
        $category->name=$r->category_name;
        $category->creator=$admin->name;
        $category->save();

        return redirect()
            ->route('admin.categories')
            ->with('success', "Category " . $r->category_name . " added successfully");
    }

    public function delete_category($id){
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect()
                ->route('admin.categories')
                ->with('success', "Category " . $category->name . " deleted successfully");
        } else {
            return redirect()
                ->route('admin.categories')
                ->with('error', "Category not found");
        }
    }

    public function edit_category($id){
        $admin=Session::get('admin');

        $category = Category::find($id);

        if ($category) {
            return view('admin.edit-category', compact('admin','category'));
        } else {
            return redirect()
                ->route('admin.categories')
                ->with('error', "Category not found");
        }
    }

    public function update_category(Request $r, $id){
        $validation=$r->validate([
            'category_name'=>'required|min:3|unique:categories,name,'.$id
        ]);

        $category=Category::find($id);

        if($category){
            $category->name=$r->category_name;
            $category->save();

            return redirect()
                ->route('admin.categories')
                ->with('success', "Category " . $r->category_name . " updated successfully");
        }else{
            return redirect()
                ->route('admin.categories')
                ->with('error', "Category not found");
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
        $quizzes = Quiz::with('category','mcqs')->orderBy('created_at', 'desc')->paginate(8);
        $totalMcqs = 0;

        if(Session::has('quizDetails')){
            $quizDetails=Session::get('quizDetails');
            $totalMcqs=Mcq::where('quiz_id',$quizDetails->id)->count();
        }

        return view('admin.add-quiz', compact('admin', 'categories', 'totalMcqs', 'quizzes'));
    }

    public function add_quiz(Request $r)
    {
        $admin = Session::get('admin');

        $validation = $r->validate([
            'quiz_name'   => 'required|min:3|unique:quizzes,name',
            'category_id' => 'required|exists:categories,id'
        ]);

        $quiz = new Quiz();
        $quiz->name = $r->quiz_name;
        $quiz->category_id = $r->category_id;

        if ($quiz->save()) {
            Session::put('quizDetails', $quiz);

            return redirect()
                ->route('admin.quiz.form')
                ->with('success', 'Quiz Added Successfully!');
        }
    }

    public function edit_quiz($id){
        $admin=Session::get('admin');
        $quiz=Quiz::find($id);
        $categories = Category::orderBy('created_at', 'desc')->get();

        if($quiz){
            return view('admin.edit-quiz',compact('admin','quiz','categories'));
        }else{
            return redirect()
                ->route('admin.quiz.form')
                ->with('error', "Quiz not found");
        }
    }

    public function update_quiz(Request $r, $id){
        $validation=$r->validate([
            'quiz_name'=>'required|min:3|unique:quizzes,name,'.$id,
            'category_id'=>'required|exists:categories,id'
        ]);

        $quiz=Quiz::find($id);

        if($quiz){
            $quiz->name=$r->quiz_name;
            $quiz->category_id=$r->category_id;
            $quiz->save();

            return redirect()
                ->route('admin.quiz.form')
                ->with('success', "Quiz " . $r->quiz_name . " updated successfully");
        }else{
            return redirect()
                ->route('admin.quiz.form')
                ->with('error', "Quiz not found");
        }
    }

    public function delete_quiz($id){
        $quiz=Quiz::find($id);

        if($quiz){
            // Delete associated MCQs first
            Mcq::where('quiz_id', $quiz->id)->delete();

            $quiz->delete();

            return redirect()
                ->route('admin.quiz.form')
                ->with('success', "Quiz " . $quiz->name . " deleted successfully");
        }else{
            return redirect()
                ->route('admin.quiz.form')
                ->with('error', "Quiz not found");
        }
    }
    
    public function add_mcqs(Request $r){
        $admin=Session::get('admin');
        $quizDetails=Session::get('quizDetails');

        if(!$quizDetails){
            return redirect()
                ->route('admin.quiz.form')
                ->with('error', 'Please add a quiz first.');
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
                return redirect()
                    ->back()
                    ->with('success', 'MCQ Added Successfully! Add more MCQs.');
            }else{
                Session::forget('quizDetails');

                return redirect()
                    ->route('admin.quiz.form')
                    ->with('success', 'MCQ Added Successfully! Quiz creation completed.');
            }
        }
    }

    public function cancel_quiz(){
        $admin=Session::get('admin');

        Session::forget('quizDetails');

        return redirect()
            ->route('admin.quiz.form')
            ->with('success', 'Quiz creation cancelled.');
    }

    public function show_quiz($id,$quiz_name){
        $admin=Session::get('admin');
        $mcqs=Mcq::where('quiz_id',$id)->get()
        ;
        return view('admin.show-quiz',compact('admin','mcqs','quiz_name'));
    }

    public function edit_mcq($id){
        $admin=Session::get('admin');

        $mcq=Mcq::findOrFail($id);

        if($mcq){
            return view('admin.edit-mcq',compact('admin','mcq'));
        }else{
            return redirect()
                ->back()
                ->with('error', "MCQ not found");
        }
    }

    public function update_mcq(Request $r, $id){
        $validation=$r->validate([
            'question'=>'required|min:5',
            'option_a'=>'required|min:1',
            'option_b'=>'required|min:1',
            'option_c'=>'required|min:1',
            'option_d'=>'required|min:1',
            'correct_option'=>'required|in:option_a,option_b,option_c,option_d'
        ]);

        $mcq=Mcq::with('quiz')->findOrFail($id);

        if($mcq){
            $mcq->question=$r->question;
            $mcq->option_a=$r->option_a;
            $mcq->option_b=$r->option_b;
            $mcq->option_c=$r->option_c;
            $mcq->option_d=$r->option_d;
            $mcq->correct_option=$r->correct_option;
            $mcq->save();

            return redirect()
                ->route('admin.quiz.show', ['id' => $mcq->quiz->id, 'quiz_name' => $mcq->quiz->name])
                ->with('success', "MCQ updated successfully");
        }else{
            return redirect()
                ->back()
                ->with('error', "MCQ not found");
        }
    }

    public function quiz_list($id,$category){
        $admin=Session::get('admin');
        $quizzes=Quiz::with('mcqs')->where('category_id',$id)->get();

        return view('admin.quiz-list',compact('admin','quizzes','category'));
    }

    public function delete_mcq($id){
        $mcq=Mcq::with('quiz')->findOrFail($id);

        if($mcq){
            $quizId = $mcq->quiz->id;
            $quizName = $mcq->quiz->name;

            $mcq->delete();

            return redirect()
                ->route('admin.quiz.show', ['id' => $quizId, 'quiz_name' => $quizName])
                ->with('success', "MCQ deleted successfully");
        }else{
            return redirect()
                ->back()
                ->with('error', "MCQ not found");
        }
    }

    public function contact_queries(){
        $admin=Session::get('admin');
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.contact-queries', compact('admin', 'messages'));
    }

}
