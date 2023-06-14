<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    // Profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/change-role', [UserController::class, 'changeRole'])->name('users.change_role');
        Route::patch('/{user}/change-role', [UserController::class, 'updateRole'])->name('users.update_role');
    });

    Route::middleware('role:teacher,staff')->group(function() {
        Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
        Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
    });

    Route::middleware(['role:except,teacher,staff', 'user.check'])->group(function() {
        Route::patch('loans/{loan}/{user}/approve', [LoanController::class, 'approve'])->name('loans.approve');
        Route::patch('loans/{loan}/{user}/disapprove', [LoanController::class, 'disapprove'])->name('loans.disapprove');
    });

    // Loans
    Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('loans/{loan}', [LoanController::class, 'show'])->name('loans.show');

});

require __DIR__ . '/auth.php';

Route::redirect('/', '/login');
