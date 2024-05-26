<?php

use App\Http\Controllers\LandingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,'indexview']);
Route::post('/',[AuthController::class,'storeindex']);
Route::get('/sign-up',[AuthController::class,'index']);
Route::post('/sign-up',[AuthController::class,'storeSignup']);
Route::get('/email/verification/{token}',[AuthController::class,'verification']);
Route::get('/kitchen-chef',[LandingPage::class,'LandingPage']);
Route::middleware('is_admin')->group(function(){
    Route::get('/admin/dashboard',[AdminController::class ,'dashboard']);
    Route::get('/admin/users/table',[AdminController::class,'userstable']);
    Route::get('/admin/profile',[AdminController::class,'profile']);
    Route::post('/admin/profile',[AdminController::class,'updateprofile']);
    Route::get('/admin/add/menu',[AdminController::class,'addMenu']);
    Route::post('/admin/add/item',[AdminController::class,'additem']);
    Route::post('/admin/add/category',[AdminController::class,'addCategory']);
    Route::get('/admin/category/list',[AdminController::class,'showCategory']);
    Route::get('/admin/category/edit/{id}',[AdminController::class,'editCat']);
    Route::post('/admin/category/edit/',[AdminController::class,'updateCat']);
    Route::get('/admin/category/delete/{id}',[AdminController::class,'deleteCat']);
    Route::get('/logout',[AuthController::class,'logout']);
});



