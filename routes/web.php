<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubModuleController;
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
Route::match(['GET', 'POST'], 'login', [LoginController::class, 'login'])->name('login');

Route::get('logout', [HomeController::class, 'logout'])->name('logout');
Auth::routes();

Route::middleware(['CheckAdmin'])->group(function(){

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::post('users/email-exists', [UserController::class,'isEmailExists'])->name('isEmailExists');
    Route::post('users/update_status/{id}', [UserController::class,'status_update'])->name('user.update_status');
    Route::post('users/update/{id}', [UserController::class,'update'])->name('user.modify');
    Route::get('users/edit-confirmPassword/{id}', [UserController::class, 'editPassword'])->name('user.edit_confirmPassword');
    Route::post('users/update-confirmPassword/{id}', [UserController::class, 'updatePassword'])->name('user.update_confirmPassword');
    
    //  Lead Routes

    Route::get('leads', [LeadController::class, 'index'])->name('lead');
    Route::match(['GET', 'POST'], 'leads/create', [LeadController::class, 'create'])->name('create');
    Route::get('leads/edit/{id}', [LeadController::class, 'edit'])->name('edit');
    Route::post('leads/update/{id}', [LeadController::class, 'update'])->name('update');
    Route::delete('leads/delete/{id}', [LeadController::class, 'delete'])->name('lead.destroy');
    Route::post('leads/upload-media/{id}', [LeadController::class,'uploadLeadMedia'])->name('lead.upload.media');
    Route::post('leads/media/delete', [LeadController::class,'lead_media_delete'])->name('lead.media.delete');
    Route::match(['GET', 'POST'], 'leads/chat/{id}', [LeadController::class,'leadChat'])->name('lead.chat');

    //Role Routes

    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::get('role/action/{id}', [RoleController::class, 'roleAction'])->name('role.action');

    //Module Controller

    Route::get('modules', [ModuleController::class, 'index'])->name('module');
    Route::match(['GET', 'POST'], 'modules/create', [ModuleController::class, 'create'])->name('module.create');
    Route::get('modules/edit/{secret}', [ModuleController::class, 'moduleEdit'])->name('module.edit');
    Route::post('modules/update/{secret}', [ModuleController::class, 'moduleUpdate'])->name('module.update');
    Route::delete('modules/delete/{secret}', [ModuleController::class, 'moduleDelete'])->name('module.delete');

    //Sub Module Controller

    Route::get('subModules', [SubModuleController::class, 'index'])->name('submodule');
    Route::match(['GET', 'POST'], 'subModule/create', [SubModuleController::class, 'create'])->name('subModule.create');
    Route::get('subModules/edit/{secret}', [SubModuleController::class, 'editModule'])->name('subModule.edit');
    Route::post('subModules/update/{secret}', [SubModuleController::class, 'updateSubmodule'])->name('subModules.update');
    Route::delete('subModules/delete/{secret}', [SubModuleController::class, 'deleteSubModule'])->name('subModules.delete');

});


