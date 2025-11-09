<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;

Route::get('/', fn() => redirect()->route('login'));

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Resume Routes
Route::middleware('auth')->group(function() {
    Route::get('/resume/edit', [ResumeController::class, 'edit'])->name('resume.edit');
    Route::put('/resume/update', [ResumeController::class, 'update'])->name('resume.update');
});

// Public Resume
Route::get('/resume/{id}', [ResumeController::class, 'showPublic'])->name('resume.public');