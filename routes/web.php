<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsing;
use App\Http\Controllers\KategoryController;
use App\Models\kategories;
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


Route::middleware(['auth:sanctum', 'verified'])->get('/borrowing', [KategoryController::class,'show']);

Route::middleware(['auth:sanctum', 'verified'])->get('/borrowing/{nazev:nazev}', [KategoryController::class,'showKategory']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
