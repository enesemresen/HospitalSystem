<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserIdentityController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AnalyseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/get-all-doctors', [UserController::class, 'getAllDoctors']);
    Route::get('/get-identity-analyse', [UserController::class, 'getAllIdentityAndAnalyse']);
    Route::get('/get-identity-with-mother-name', [UserController::class, 'getIdentityWithMotherName']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
    
});

Route::prefix('user_identities')->group(function () {
    Route::get('/', [UserIdentityController::class, 'index']);
    Route::post('/', [UserIdentityController::class, 'store']);
    Route::get('/{userIdentity}', [UserIdentityController::class, 'show']);
    Route::put('/{userIdentity}', [UserIdentityController::class, 'update']);
    Route::delete('/{userIdentity}', [UserIdentityController::class, 'destroy']);
});

Route::prefix('polyclinics')->group(function () {
    Route::get('/', [PolyclinicController::class, 'index']);
    Route::post('/', [PolyclinicController::class, 'store']);
    Route::get('/{polyclinic}', [PolyclinicController::class, 'show']);
    Route::put('/{polyclinic}', [PolyclinicController::class, 'update']);
    Route::delete('/{polyclinic}', [PolyclinicController::class, 'destroy']);
});

Route::prefix('hospitals')->group(function () {
    Route::get('/', [HospitalController::class, 'index']);
    Route::post('/', [HospitalController::class, 'store']);
    Route::get('/{hospital}', [HospitalController::class, 'show']);
    Route::put('/{hospital}', [HospitalController::class, 'update']);
    Route::delete('/{hospital}', [HospitalController::class, 'destroy']);
});

Route::prefix('barcodes')->group(function () {
    Route::get('/', [BarcodeController::class, 'index']);
    Route::post('/', [BarcodeController::class, 'store']);
    Route::get('/{barcode}', [BarcodeController::class, 'show']);
    Route::put('/{barcode}', [BarcodeController::class, 'update']);
    Route::delete('/{barcode}', [BarcodeController::class, 'destroy']);
});

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentController::class, 'index']);
    Route::post('/', [AppointmentController::class, 'store']);
    Route::get('/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/{appointment}', [AppointmentController::class, 'update']);
    Route::delete('/{appointment}', [AppointmentController::class, 'destroy']);
});

Route::prefix('analyses')->group(function () {
    Route::get('/', [AnalyseController::class, 'index']);
    Route::post('/', [AnalyseController::class, 'store']);
    Route::get('/{analyse}', [AnalyseController::class, 'show']);
    Route::put('/{analyse}', [AnalyseController::class, 'update']);
    Route::delete('/{analyse}', [AnalyseController::class, 'destroy']);
});