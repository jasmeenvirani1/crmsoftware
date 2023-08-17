<?php

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/signup', [AuthController::class, 'signup']);
Route::group(['prefix' => 'v1', 'namespace' => 'API\V1', 'middleware' => ['auth:api']], function () {

    // Route::group(['middleware' => ['guest:api']], function () {
    Route::post('otp_verification', [AuthController::class, 'verifyOTP']);
    Route::get('get-category', [ApiController::class, 'GetCategory']);
    Route::post('create-category', [ApiController::class, 'StoreCategory']);
    Route::post('edit-category', [ApiController::class, 'EditCategory']);
    Route::post('update-category', [ApiController::class, 'UpdateCategory']);
    Route::post('delete-category', [ApiController::class, 'DeleteCategory']);
    Route::get('get-group', [ApiController::class, 'GetGroup']);
    Route::post('change-group', [ApiController::class, 'ChangeGroup']);

    Route::group(['prefix' => 'catalogue',], function () {
        Route::get('get-catalogue', [ApiController::class, 'GetCatalogue']);
    });
    Route::group(['prefix' => 'company',], function () {
        Route::get('get-company', [ApiController::class, 'GetCompany']);
        Route::post('set-default-company', [ApiController::class, 'SetDefaultCompany']);
    });
    Route::group(['prefix' => 'vendor',], function () {
        Route::get('/', [ApiController::class, 'GetVendors']);
        Route::post('store', [ApiController::class, 'StoreVendor']);
        Route::post('edit', [ApiController::class, 'EditVendor']);
        Route::post('update', [ApiController::class, 'UpdateVendor']);
        Route::post('delete', [ApiController::class, 'DeleteVendor']);
    });

    Route::group(['prefix' => 'product',], function () {
        Route::get('/', [ApiController::class, 'GetProducts']);
        Route::post('store', [ApiController::class, 'StoreProduct']);
        Route::post('edit', [ApiController::class, 'EditProduct']);
        Route::post('update', [ApiController::class, 'UpdateProduct']);
        Route::post('delete', [ApiController::class, 'DeleteProduct']);
        Route::post('image-delete', [ApiController::class, 'DeleteProductImage']);
    });
    Route::group(['prefix' => 'profile',], function () {
        Route::get('/', [ApiController::class, 'GetProfile']);
        Route::post('update', [ApiController::class, 'UpdateProfile']);
    });


    Route::get('get-state', [App\Http\Controllers\API\V1\CommanList::class, 'getState']);
    Route::post('edit/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'editCategory']);
    Route::post('delete/{id}', [App\Http\Controllers\API\V1\CommanList::class, 'deleteCategory']);
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
