<?php

use App\Http\Controllers\TaskController;
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

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [TaskController::class, 'Registration']);
Route::post('login-user', [TaskController::class, 'loginuser'])->name('login-user');
Route::get('/Logout', [TaskController::class, 'Logout']);

Route::get('/Dashboard', [TaskController::class, 'Dashboard']);
