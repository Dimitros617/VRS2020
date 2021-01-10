<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LoansController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsing;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListUsersController;
use App\Http\Controllers\MessagesController;
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

Route::get('/dashboardNew', function () {    return view('dashboardNew');});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/loans',[LoansController::class,'showLoans']);
Route::middleware(['auth:sanctum', 'verified', 'permition:return_verification'])->get('/all-loans',[LoansController::class,'showAllLoans']);

Route::middleware(['auth:sanctum', 'verified', 'permition:return_verification'])->get('/item/{id:id}/activeLoans', [LoansController::class,'showItemLoans']);
Route::middleware(['auth:sanctum', 'verified', 'permition:return_verification'])->get('/categories/{id:id}/activeLoans', [LoansController::class,'showCategoryLoans']);

Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories', [CategoryController::class,'showCategories']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting'])->get('/categories/{name:name}', [CategoryController::class,'showItem']) ->name('item');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);

//Zprávy
Route::get('/newMessages', [MessagesController::class,'countNewMessages']);
Route::get('/allMessages', [MessagesController::class,'showAllMessages']);
Route::get('/changeMessagePriority/{id?}', [MessagesController::class,'changeMessagePriority']);
Route::get('/removeMessage/{id?}', [MessagesController::class,'removeMessage']);
Route::get('/sendMessage/{nick:nick}/{text?}', [MessagesController::class,'sendMessage']);

//Uživatelé
Route::post('/users/{id:id}/saveUserData', [ListUsersController::class,'saveUserData']);
Route::get('/users/usersSort/{sort?}', [ListUsersController::class,'usersSort']);
Route::get('/users/usersFind/{find?}', [ListUsersController::class,'usersFind']);
Route::get('/getUserNames', [ListUsersController::class,'getUserNames']);

//Categorie
Route::post('/saveCategoryData', [CategoryController::class,'saveCategory']);
Route::post('/categories/addNewCategory', [CategoryController::class,'addNewCategory']);
Route::post('/categories/{id:id}/removeCategory', [CategoryController::class,'removeCategory']);
Route::post('/categories/{id:id}/removeCategoryHard', [CategoryController::class,'removeCategoryHard']);
Route::get('/categories/checkCategoryNameExist/{name?}', [CategoryController::class,'checkCategoryNameExist']);
Route::get('/categories/categoriesSort/{sort?}', [CategoryController::class,'categoriesSort']);
Route::get('/categories/categoriesFind/{find?}', [CategoryController::class,'categoriesFind']);

//Itemy
Route::post('/item/addNewItem', [ItemsController::class,'addNewItem']);
Route::post('/item/{id:id}/saveItemData', [ItemsController::class,'saveItem']);
Route::post('/item/{id:id}/changeItemAvailability', [ItemsController::class,'changeItemAvailability']);
Route::post('/item/{id:id}/removeItem', [ItemsController::class,'removeItem']);
Route::post('/item/{id:id}/removeItemHard', [ItemsController::class,'removeItemHard']);

//Vůpůjčky
//Route::post('/item/{id:id}/activeLoans', [LoansController::class,'showItemLoans']);
//Route::post('/categories/{id:id}/activeLoans', [LoansController::class,'showCategoryLoans']);
Route::post('/item/{id:id}/saveItemLoansData', [LoansController::class,'saveItemLoans']);
Route::post('/loans/{id:id}/return', [LoansController::class,'itemLoansReturn']);






