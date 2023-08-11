<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
// Auth::routes();
Route::post('v1/login', [App\Http\Controllers\API\V1\AuthController::class, 'login']);
Route::post('v1/signup', [App\Http\Controllers\API\V1\AuthController::class, 'signup']);
Route::group(['prefix' => 'v1', 'namespace' => 'API\V1', 'middleware' => 'checkHeader'], function () {
    // Route::group(['middleware' => ['guest:api']], function () {
        Route::post('otp_verification', [App\Http\Controllers\API\V1\AuthController::class, 'verifyOTP']);
        // Route::post('create-category',[CategoryController::class,'create'])->name('create');
        Route::get('get-state', [App\Http\Controllers\API\V1\CommanList::class, 'getState']);
        Route::get('get-category', [App\Http\Controllers\API\V1\CommanList::class, 'getCategory']);
        Route::post('create-category', [App\Http\Controllers\API\V1\CommanList::class, 'createCategory']);
        Route::post('edit/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'editCategory']);
        Route::post('delete/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'deleteCategory']);
        Route::post('create-product', [App\Http\Controllers\API\V1\CommanList::class, 'createproduct']);
        Route::post('editproduct/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'editproduct']);
        Route::post('deleteproduct/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'deleteproduct']);
        Route::get('get-product', [App\Http\Controllers\API\V1\CommanList::class, 'getproduct']);
        Route::post('create-vendor', [App\Http\Controllers\API\V1\CommanList::class, 'createvendor']);
        Route::post('edit-vendor/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'editvendor']);
        Route::post('delete-vendor/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'deletevendor']);
    // });
});

Route::group(['middleware' => ['checkHeader', 'auth:api']], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function () {
        Route::post('logout', [App\Http\Controllers\API\V1\AuthController::class, 'logout']);
        Route::post('get-profile-data', [App\Http\Controllers\API\V1\AuthController::class, 'getProfileData']);
    });
});
