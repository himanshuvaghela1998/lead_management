<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
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

Route::resource('/users', UserController::class);
Route::post('users/email-exists', [UserController::class,'isEmailExists'])->name('isEmailExists');
Route::post('users/update_status/{id}', [UserController::class,'status_update'])->name('user.update_status');
// <!--- Lead Controller -->

Route::get('Leads', [LeadController::class, 'index'])->name('lead');
Route::match(['GET', 'POST'], 'create', [LeadController::class, 'create'])->name('create');
Route::get('edit/{id}', [LeadController::class, 'edit'])->name('edit');
