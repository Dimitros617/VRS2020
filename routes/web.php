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


Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories', [CategoryController::class,'showCategories']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories/{name:name}', [CategoryController::class,'showItem']) ->name('item');

Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');

Route::post('/item/{id:id}/saveItemLoansData', [CategoryController::class,'saveItemLoans']);
Route::post('/item/{id:id}/saveItemData', [CategoryController::class,'saveItem']);
Route::post('/saveCategoryData', [CategoryController::class,'saveCategory']);

Route::post('/item/{id:id}/removeItem', [CategoryController::class,'removeItem']);
Route::post('/item/{id:id}/removeItemHard', [CategoryController::class,'removeItemHard']);

Route::post('/item/{id:id}/activeLoans', [CategoryController::class,'showItemStatus']);
Route::post('/item/{id:id}/changeItemAvailability', [CategoryController::class,'changeItemAvailability']);

Route::post('/item/addNewItem', [CategoryController::class,'addNewItem']);
Route::post('/categories/addNewCategory', [CategoryController::class,'addNewCategory']);
