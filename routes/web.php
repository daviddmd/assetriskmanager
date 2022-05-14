<?php

use App\Enums\UserRole;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermanentContactPointController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityOfficerController;
use App\Http\Controllers\ThreatController;
use App\Http\Controllers\UserController;
use App\Models\Asset;
use App\Models\AssetThreatControl;
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
    return redirect()->route("dashboard");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get("dashboard", DashboardController::class)->name("dashboard");
    Route::resource("permanent-contact-point", PermanentContactPointController::class);
    Route::resource("security-officer", SecurityOfficerController::class);
    Route::resource("asset-types", AssetTypeController::class);
    Route::resource("departments", DepartmentController::class);
    Route::resource("users", UserController::class);
    Route::resource("threats", ThreatController::class);
    Route::resource("controls", ControlController::class);
    Route::resource("assets", AssetController::class);
    Route::get("reports", ReportController::class)->name("reports");
});
