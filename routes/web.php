<?php

use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermanentContactPointController;
use App\Http\Controllers\SecurityOfficerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource("permanent-contact-point", PermanentContactPointController::class);
    Route::resource("security-officer", SecurityOfficerController::class);
    Route::resource("asset-types", AssetTypeController::class);
    Route::resource("departments", DepartmentController::class);
    Route::resource("users", UserController::class);
});
