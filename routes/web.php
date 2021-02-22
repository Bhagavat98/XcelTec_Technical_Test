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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

	

	Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	Route::get('/add-users', function () {
	    return view('add-users');
	})->name('users.add-users-view');

	//store users
	Route::post('/store-users', [App\Http\Controllers\HomeController::class, 'store'])->name('add.users');

	// edit
	Route::get('/users/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');

	//store users
	Route::post('/save-users', [App\Http\Controllers\HomeController::class, 'save'])->name('save.users');

	//store users
	Route::post('/delete-users', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete.users');


});




	
// logout
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');