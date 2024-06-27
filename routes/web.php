<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

Route::get('/', function () {
    return view('customers/create');
});

Route::resource('/customers', CustomersController::class);
