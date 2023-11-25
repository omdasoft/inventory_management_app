<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkSallaOauhToken;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'login']);
Route::post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware(['auth', checkSallaOauhToken::class]);
