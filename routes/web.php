<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Middleware\CheckTokenValidity;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'fetchUsers'])->name('fetch-users');
Route::get('/register',[UserController::class, 'showRegistrationForm'])->name('register');

Route::middleware([CheckTokenValidity::class])->group(function () {
    Route::post('/api/createNewUser', [UserController::class, 'createNewUser']);
});