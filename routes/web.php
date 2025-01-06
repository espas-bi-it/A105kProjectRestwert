<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('form/create');
});

Route::resource('/thankyou', FormController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/customers', CustomersController::class);
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/users/index', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/update', [UserManagementController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/destroy', [UserManagementController::class, 'destroy'])->name('users.destroy');
    Route::get('/graph', [CustomersController::class, 'showSuggestionsGraph']);
   
});


Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'de', 'fr'])) { // Add more languages if needed
        App::setLocale($lang);
        Session::put('locale', $lang);
    }
    return redirect()->back(); // Redirect back to the previous page
})->name('locale.switch');

require __DIR__ . '/auth.php';
