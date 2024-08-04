<?php

use App\Http\Controllers\LandingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
Route::get('/test',function(){
    return view('UsersPage.booktable');
});
Route::get('/',[LandingPage::class,'LandingPage']);
Route::get('/login',[AuthController::class,'indexview']);
Route::post('/login',[AuthController::class,'storeindex']);
Route::get('/sign-up',[AuthController::class,'index']);
Route::post('/sign-up',[AuthController::class,'storeSignup']);
Route::get('/email/verification/{token}',[AuthController::class,'verification']);
Route::middleware('is_admin')->group(function(){
    Route::get('/logout',[AuthController::class,'logout']);

    Route::get('/admin/dashboard',[AdminController::class ,'dashboard']);
    Route::get('/admin/users/table',[AdminController::class,'userstable']);

    Route::get('/admin/profile',[AdminController::class,'profile']);
    Route::post('/admin/profile',[AdminController::class,'updateprofile']);


    Route::get('/admin/add/menu',[AdminController::class,'addMenu']);
    Route::post('/admin/add/item',[AdminController::class,'additem']);
    Route::get('/admin/edit/item/{id}',[AdminController::class,'editMenu']);
    Route::post('/admin/edit/item/',[AdminController::class,'updateMenu']);


    Route::post('/admin/add/category',[AdminController::class,'addCategory']);
    Route::get('/admin/category/list',[AdminController::class,'showCategory']);
    Route::get('/admin/category/edit/{id}',[AdminController::class,'editCat']);
    Route::post('/admin/category/edit/',[AdminController::class,'updateCat']);
    Route::get('/admin/category/delete/{id}',[AdminController::class,'deleteCat']);


    Route::get('/admin/event/list',[AdminController::class,'event']);
    Route::post('/admin/event/add',[AdminController::class,'eventAdd']);
    Route::get('/admin/event/edit/{id}',[AdminController::class,'editEvent']);
    Route::post('/admin/event/edit/',[AdminController::class,'updateEvent']);
    Route::get('/admin/event/delete/{id}',[AdminController::class,'deleteEvent']);


    Route::get('/admin/employee/list',[AdminController::class,'Employeelist']);
    Route::post('/admin/employee/add',[AdminController::class,'addEmployee']);
    Route::get('/admin/employee/edit/{id}',[AdminController::class,'editEmployee']);
    Route::post('/admin/employee/edit/',[AdminController::class,'updateEmployee']);
    Route::get('/admin/employee/delete/{id}',[AdminController::class,'deleteEmployee']);


    // ===========================User Route Start=====================================
    Route::get('/users/booktable',[UserController::class,'booktable'])->name('reservation');
    Route::get('/users/profile',[UserController::class,'userProfile']);
    Route::post('/users/profile',[UserController::class,'updateProfile']);
    Route::get('/users/menu',[UserController::class,'menuitem']);
    // ===========================User Route End=======================================
});



