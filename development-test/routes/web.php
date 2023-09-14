<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DocumentsController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Documents Management Route
Route::resource('documents', DocumentsController::class);

// Update Profile Route
Route::get('/{id}', [UsersController::class, 'detail'])->name('users.detail');
Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::patch('/{id}/update', [UsersController::class, 'update'])->name('users.update');
