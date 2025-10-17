<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// For ADMIN 
Route::view('admin-login', 'admin-login');
Route::post('/admin-login',[AdminController::class,'login'])->name('admin.login');
Route::get('/admin-logout',[AdminController::class,'logout'])->name('admin.logout');

Route::middleware('admin-auth')->group(function (){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/admin-categories',[AdminController::class,'categories'])->name('admin.categories');
    Route::post('/add-category',[AdminController::class,'add_category'])->name('admin.category.add');
    Route::delete('/delete-category/{id}',[AdminController::class,'delete_category'])->name('admin.category.delete');
    Route::get('/add-quiz', [AdminController::class, 'show_add_quiz_form'])->name('admin.quiz.form');
    Route::post('/add-quiz', [AdminController::class, 'add_quiz'])->name('admin.quiz.add');
    Route::post('/add-mcqs', [AdminController::class, 'add_mcqs'])->name('admin.mcqs.add');
    Route::get('/cancel-quiz', [AdminController::class, 'cancel_quiz'])->name('admin.quiz.cancel');
    Route::get('/show-quiz/{id}/{quiz_name}', [AdminController::class, 'show_quiz'])->name('admin.quiz.show');
    Route::get('/quiz-list/{id}/{category}', [AdminController::class, 'quiz_list'])->name('admin.quiz.list');
});


// For USER
Route::get('/',[UserController::class,'welcome'])->name('welcome');

Route::get('/quizzes',[UserController::class,'all_quizzes'])->name('user.all.quizzes');
Route::get('/user-quiz-list/{id}/{category}',[UserController::class,'quiz_list'])->name('user.quiz.list');
Route::get('/start-quiz/{id}/{quiz_name}',[UserController::class,'start_quiz'])->name('user.quiz.start');

Route::middleware('guest-user')->group(function (){
    Route::get('/user-signup',[UserController::class,'signup_form'])->name('user.signup.form');
    Route::post('/user-signup',[UserController::class,'signup'])->name('user.signup');
    Route::get('/user-signup-quiz',[UserController::class,'signup_form_quiz'])->name('user.signup.quiz');
    Route::get('/user-login', [UserController::class,'user_login_form'])->name('user.login.form');
    Route::post('/user-login', [UserController::class,'user_login'])->name('user.login');
    Route::get('/user-login-quiz', [UserController::class,'user_login_form_quiz'])->name('user.login.form.quiz');
});

Route::get('/user-logout',[UserController::class,'user_logout'])->name('user.logout');

Route::middleware('user-auth')->group(function (){
    Route::get('/mcq/{id}/{quiz_name}',[UserController::class,'mcq'])->name('user.mcq');
    Route::post('/quiz-submit-next',[UserController::class,'quiz_submit_next'])->name('user.quiz.submit.next');
    Route::get('/user-details',[UserController::class,'user_details'])->name('user.details');
});

// User email verification routes 
Route::get('/verify-user/{token}',[UserController::class,'verify_user'])->name('user.verify');

// Forgot password routes
Route::get('/forgot-password',[UserController::class,'show_forgot_password_form'])->name('user.password.request');
Route::post('/forgot-password',[UserController::class,'sent_reset_link_email'])->name('user.password.email');
Route::get('/reset-password/{token}',[UserController::class,'show_reset_password_form'])->name('user.password.reset');
Route::post('/reset-password',[UserController::class,'reset_password'])->name('user.password.update');

