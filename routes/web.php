<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LoansController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsing;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListUsersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PermitionController;
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
Route::get('/credentials', function () {    return view('credentials');});

//Route::get('/dashboardNew', function () {    return view('dashboardNew');});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'show']) ->name('dashboard');

//TODO: GET route pro ORION prihlaseni
//TODO: mailer

Route::middleware(['auth:sanctum', 'verified'])->get('/loans',[LoansController::class,'showLoans'])->name('loans');
Route::middleware(['auth:sanctum', 'verified', 'permition:return_verification'])->get('/all-loans',[LoansController::class,'showAllLoans']);

Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/item/{id}/activeLoans', [LoansController::class,'showItemLoans']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/categories/{id:id}/activeLoans', [LoansController::class,'showCategoryLoans']);

//Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/categories', [CategoryController::class,'showCategories']);
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/categories/{name:name}', [CategoryController::class,'showItem'])->name('item');    //tohle se da do sub
//edited
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/departments', [DepartmentController::class,'showDepartments'])->name('departments');
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/departments/{short}', [DepartmentController::class,'getDepartment'])->name('show-department');
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/departments/{short}/{name:name}', [CategoryController::class,'showItem'])->name('item');    //tohle se da do sub
Route::middleware(['auth:sanctum', 'verified', 'permition:possibility_renting,return_verification,edit_item,OR'])->get('/item-detail/{inventory_number:inv_num}', [CategoryController::class,'showItemDetail'])->name('item-detail');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [ListUsersController::class,'showAllUsers']);
Route::middleware(['auth:sanctum', 'verified', 'permition:new_user'])->get('/users/{id:id}', [ListUsersController::class,'showUser']);
Route::middleware(['auth:sanctum', 'verified'])->get('/users/{id:id}/loans', [ListUsersController::class,'showLoans']);

Route::middleware(['auth:sanctum', 'verified', 'permition:edit_permitions'])->get('/permitions', [PermitionController::class,'showPermissions']);

Route::get('/clearLoansHistory', [LoansController::class,'clearHistory']);

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
Route::post('/{short}/saveCategoryData', [CategoryController::class,'saveCategory'])->name('save-category');
Route::post('/categories/{id:id}/removeCategoryHard', [CategoryController::class,'removeCategoryHard']);
Route::get('/categories/{id:id}/removeCategory', [CategoryController::class,'removeCategory']);
Route::get('/categories/checkCategoryNameExist/{department_id}/{name?}', [CategoryController::class,'checkCategoryNameExist']);
Route::get('/categories/categoriesSort/{sort?}', [CategoryController::class,'categoriesSort']);
Route::get('/categories/categoriesFind/{find?}', [CategoryController::class,'categoriesFind']);

//Katedry
Route::post('/{short}/saveDepartmentData', [DepartmentController::class,'saveDepartment'])->name('save-department');
Route::post('/departments/addNewDepartment', [DepartmentController::class,'addNewDepartment']);
Route::post('/departments/{short}/addNewCategory', [CategoryController::class,'addNewCategory'])->name('add-category');     //pridani nove ktegorie do katedry
Route::get('/removeDepartment/{id:id}', [DepartmentController::class,'removeDepartment']);  
Route::post('/removeDepartmentHard/{id:id}', [DepartmentController::class,'removeDepartmentHard']);  

//Itemy
Route::post('/item/addNewItem', [ItemsController::class,'addNewItem']);
Route::post('/item/{id:id}/saveItemData', [ItemsController::class,'saveItem']);
Route::post('/item/{id:id}/removeItemHard', [ItemsController::class,'removeItemHard']);
Route::get('/item/{id:id}/removeItem', [ItemsController::class,'removeItem']);
Route::get('/item/{id:id}/changeItemAvailability', [ItemsController::class,'changeItemAvailability']);
Route::get('/categories/itemsSort/{sort?}', [ItemsController::class,'itemsSort']);

//Vůpůjčky
Route::post('/item/{id:id}/saveItemLoansData', [LoansController::class,'saveItemLoans']);
Route::get('/loans/{id:id}/return', [LoansController::class,'itemLoansReturn']);

//Oprávnění
Route::post('/addPermition', [PermitionController::class,'addPermition']);
Route::post('/savePermitionData', [PermitionController::class,'savePermitionData']);
Route::get('/removePermition/{id:id}', [PermitionController::class,'removePermition']);




