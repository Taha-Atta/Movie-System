<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\CategoryController;
use App\Http\Controllers\Api\User\CustomerController;
use App\Http\Controllers\Api\User\ReviewController;
use App\Http\Controllers\Api\User\SearchController;

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




Route::post('/customer/register', [AuthController::class, 'CustomerRegister']);
Route::post('/customer/login', [AuthController::class, 'CustomerLogin']);




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/customer/logout', [AuthController::class, 'CustomerLogout']);
    Route::post('/customer/updateProfile/{id}', [CustomerController::class, 'updateProfile']);

    Route::put('/customer/updateProfileImage/{id}', [CustomerController::class, 'updateProfileImage']);


    Route::get('/customer/showHistory/{id}', [CustomerController::class, 'showHistory']);
    Route::delete('/customer/clearAllHistory/{id}', [CustomerController::class, 'clearAllHistory']);
    Route::post('/customer/clearSingleHistory', [CustomerController::class, 'clearSingleHistory']);

});

    Route::get('/customer/AllCategory', [CategoryController::class, 'AllCategory']);

    Route::post('/customer/searchByCategory', [SearchController::class, 'searchByCategory']);
    Route::post('/customer/searchMoviePaidOrFree', [SearchController::class, 'searchMoviePaidOrFree']);


    Route::post('/customer/CreateReview', [ReviewController::class, 'CreateReview']);
    Route::put('/customer/EditReview/{id}', [ReviewController::class, 'EditReview']);
    Route::delete('/customer/DeleteReview/{id}', [ReviewController::class, 'DeleteReview']);


    Route::post('/customer/CanShowMovies', [CustomerController::class, 'CanShowMovies'])->middleware('paid');
