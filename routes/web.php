<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login', 'admin-login');

Route::post('/admin-login/',[AdminController::class,'login']);
Route::get('/dashboard/',[AdminController::class,'dashboard']);
