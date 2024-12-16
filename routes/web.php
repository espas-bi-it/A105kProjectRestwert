<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form/create');
});

Route::resource('/thankyou', FormController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/graph', [CustomersController::class, 'showSuggestionsGraph']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/customers', CustomersController::class);
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create'); // Show form
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store'); // Handle form submission
    Route::get('/users/index', [UserManagementController::class, 'index'])->name('users.index'); // Show user list
    Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show'); // Show user list
    Route::post('/users/{user}/update', [UserManagementController::class, 'update'])->name('users.update'); // Update user details
    Route::post('/users/{user}/destroy', [UserManagementController::class, 'destroy'])->name('users.destroy'); // Delete user details


});

require __DIR__ . '/auth.php';
