<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LoansController;
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


Route::middleware(['auth:sanctum', 'verified'])->get('/loans',[CategoryController::class,'showCategories']);


Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories', [CategoryController::class,'showCategories']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories/{name:name}', [CategoryController::class,'showItem']) ->name('item');

Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');


Route::post('/saveCategoryData', [CategoryController::class,'saveCategory']);
Route::post('/categories/addNewCategory', [CategoryController::class,'addNewCategory']);

Route::post('/item/addNewItem', [ItemsController::class,'addNewItem']);
Route::post('/item/{id:id}/saveItemData', [ItemsController::class,'saveItem']);
Route::post('/item/{id:id}/changeItemAvailability', [ItemsController::class,'changeItemAvailability']);
Route::post('/item/{id:id}/removeItem', [ItemsController::class,'removeItem']);
Route::post('/item/{id:id}/removeItemHard', [ItemsController::class,'removeItemHard']);


Route::post('/item/{id:id}/activeLoans', [LoansController::class,'showItemLoans']);
Route::post('/item/{id:id}/saveItemLoansData', [LoansController::class,'saveItemLoans']);





