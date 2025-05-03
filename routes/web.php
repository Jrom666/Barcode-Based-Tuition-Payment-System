<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('login');
})->name('login'); // important

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/payment', fn() => view('payment'))->name('payment');
    Route::get('/transactions', [TransactionController::class,'index'])->name('transactions');
    Route::get('/statistics', fn() => view('stat'))->name('statistics');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/register',[UserController::class,'register'])->name('register');
    Route::delete('/delete/{user}',[UserController::class,'deleteUser']);
    Route::get('/students',[StudentController::class,'index'])->name('students');
    Route::post('/addStudent',[StudentController::class,'addUser'])->name('addUser');
    Route::get('/edit-user/{user}',[UserController::class,'showEditScreen']);
    Route::put('/edit-user/{id}',[UserController::class,'updateUserInfo']);
    Route::post('/scan', [StudentController::class, 'scan'])->name('scan');
    Route::post('/process-payment',[PaymentController::class,'payment']);
});
