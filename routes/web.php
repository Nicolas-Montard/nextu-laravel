<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
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

Route::get('/', [QuestionController::class, 'index'])->name('home');
Route::controller(QuestionController::class)
->prefix('/questions')
->name('questions.')
->middleware('auth')
->group(function () {
    Route::get('/create', 'create')->name("create");
    Route::post('/create', 'store')->name("store");
    Route::get('/{question}/edit', 'edit')->name("edit");
    Route::put('/{question}/edit', 'update')->name("update");
    Route::delete('/{question}', 'destroy')->name("destroy");
});
Route::name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('do-login');
    Route::post('/logout', 'logout')->name('logout');
});
