<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin-login', 'admin-login');

Route::post('/admin-login/',[AdminController::class,'login'])->name('admin.login');
Route::get('/dashboard/',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('/admin-categories/',[AdminController::class,'categories'])->name('admin.categories');
Route::get('/admin-logout/',[AdminController::class,'logout'])->name('admin.logout');
Route::post('/add-category/',[AdminController::class,'add_category'])->name('admin.category.add');
Route::delete('/delete-category/{id}',[AdminController::class,'delete_category'])->name('admin.category.delete');