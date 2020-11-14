<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {    return view('welcome');});

Route::get('home', function () {    return view('home');});

Route::get('main', 'App\Http\Controllers\ControllerUsing@main'); //cesta ke classe, ve které je metoda s view


//Route::get('calculator', function () {    return view('calculator');});

