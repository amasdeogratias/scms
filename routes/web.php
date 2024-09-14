<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware"=>['role:super-admin|admin'], "prefix"=>'users'], function (){
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::get('roles/{id}/delete', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{id}/delete', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users.all');
    Route::get('create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::patch('/{id}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::patch('/{id}/destroy', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});
