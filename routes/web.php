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

Route::get('/', function () {
    return view('admin.index');
})->middleware(['auth', '2fa']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', '2fa']);
Route::get('/google-2fa', [App\Http\Controllers\Google2faController::class, 'sendCode'])->name('google');
Route::post('/google-2fa', [App\Http\Controllers\Google2faController::class, 'post'])->name('google.post');
Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])->name('complete-registration');
Route::get('/2fa', function () {
    return view('google2fa.index');
})->name('2fa')->middleware('2fa');
Route::post('/2fa', function () {
    return view('/home');
})->name('2fa')->middleware('2fa');
