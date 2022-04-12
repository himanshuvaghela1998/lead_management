<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Auth::routes();
Route::match(['GET', 'POST'], 'login', [LoginController::class, 'login'])->name('login');

Route::get('logout', [HomeController::class, 'logout'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home');
