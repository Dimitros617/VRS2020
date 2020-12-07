<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsing;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListUsersController;
use App\Models\categories;
use App\Models\ListUsers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|php
*/
App::setLocale('cs');

Route::get('/', function () {    return view('welcome');});


//Route::get('main', 'App\Http\Controllers\ControllerUsing@main'); //cesta ke classe, ve které je metoda s view
Route::get('main',[ControllerUsing::class,'main']);


Route::middleware(['auth:sanctum', 'verified'])->get('/borrows', function () {
    return view('my_borrows');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/categories', [CategoryController::class,'showCategories']);

Route::middleware(['auth:sanctum', 'verified'])->get('/categories/{name:name}', [CategoryController::class,'showItem']) ->name('item');
Route::post('/saveItemLoansData', [CategoryController::class,'saveItemLoans']);
Route::post('/saveItemData', [CategoryController::class,'saveItem']);
Route::post('/saveCategoryData', [CategoryController::class,'saveCategory']);

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [ListUsersController::class,'show']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');
