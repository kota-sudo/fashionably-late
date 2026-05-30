<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/register', [AuthController::class, 'register'])->middleware('guest')->name('register');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::post('/delete', [AdminController::class, 'delete']);
    Route::get('/export', [AdminController::class, 'export']);
});
