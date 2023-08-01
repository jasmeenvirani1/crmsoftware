<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\MerchantCategoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\EditQuotationController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StockManagementController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\TechnicalSpecificationController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\ExtraCustomerController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\InwardController;
use App\Http\Controllers\Admin\OutwardController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\BalancedController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\GstPercentageController;
use App\Http\Livewire\Edit;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::post('resetpasswordemail', [ResetPasswordController::class, 'forgotPasswordSendEmail'])->name('resetpasswordemail');
Route::get('reset-password/{token}/{ismobile?}', [ResetPasswordController::class, 'showPasswordResetForm']);
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('check-login-credential', [LoginController::class, 'checkCredential'])->name('check-credential');
Route::get('/', [LoginController::class, 'index']);
// Route::get('/login-temp', [LoginController::class, 'temp'])->name('temp-login');
Route::redirect('/dashboard', 'admin/dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('my-profile', [DashboardController::class, 'showMyProfilePage'])->name('my-profile');
        Route::post('saveprofile', [DashboardController::class, 'updateMyProfile'])->name('saveprofile');
        Route::get('change-password', [DashboardController::class, 'showUpdatePassword'])->name('change-password');
        Route::post('update-password', [DashboardController::class, 'udpatePassword'])->name('update-password');
        //Merchant category
        Route::resource('category', MerchantCategoryController::class);
        Route::resource('notification', NotificationController::class);
        Route::resource('role', RoleController::class);
        Route::resource('quotation', QuotationController::class);
        Route::resource('editquotation', EditQuotationController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('stock', StockManagementController::class);
        Route::post('editstore', [StockManagementController::class, 'editstore'])->name('editstore');
        Route::post('customereditstore', [CustomerController::class, 'customereditstore'])->name('customereditstore');
        Route::resource('vendor', VendorController::class);
        Route::resource('terms', TermsController::class);
        Route::resource('technicalspecification', TechnicalSpecificationController::class);
        Route::resource('purchase', PurchaseOrderController::class);
        Route::resource('extracustomer', ExtraCustomerController::class);
        Route::resource('states', StatesController::class);
        Route::resource('inward', InwardController::class);
        Route::resource('outward', OutwardController::class);
        Route::resource('organization', OrganizationController::class);
        Route::resource('balanced', BalancedController::class);
        Route::resource('gst', GstPercentageController::class);
        Route::get('stock/{id}/view', [StockManagementController::class, 'view']);
        Route::get('quotation/{id}/view', [Edit::class, 'increment']);
        Route::get('stock/{id}/view', [StockManagementController::class, 'view']);
        Route::get('stock/{id}/inward', [StockManagementController::class, 'inward']);
        Route::get('stock/{id}/balanced', [StockManagementController::class, 'balanced']);
        Route::get('stock/{id}/outward', [StockManagementController::class, 'outward']);
        Route::post('product-image-delete', [StockManagementController::class, 'productImageDelete'])->name('product.image.delete');
        Route::get('purchase/invoice/{id}', [PurchaseOrderController::class, 'invoice']);
        Route::get('quotation/invoice/{id}', [QuotationController::class, 'invoice']);
        Route::resource('catalog', CatalogController::class);
        Route::get('get-catalog/{type?}', [CatalogController::class, 'GetCatalog'])->name('catalog.get-catalog');
        Route::resource('group', GroupController::class);
        Route::post('group/change-group-id', [GroupController::class, 'ChangeGroupId'])->name('change-group-id');
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('get-cities-by-state', [CustomerController::class, 'getCity']);
Route::post('getstate', [CustomerController::class, 'getState'])->name('getstate');
Route::post('getterms', [QuotationController::class, 'getTerms'])->name('getterms');
Route::post('organization_name', [QuotationController::class, 'organization_name'])->name('organization_name');
Route::post('gettech_specification', [QuotationController::class, 'getTech_specification'])->name('gettech_specification');
Route::get('notification', [QuotationController::class, 'notification'])->name('notification');
Route::get('notification1', [PurchaseOrderController::class, 'notification'])->name('notification1');
