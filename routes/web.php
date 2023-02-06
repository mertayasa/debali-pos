<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    });
    
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('edit', [UserController::class, 'editProfile'])->name('edit');
        Route::patch('update', [UserController::class, 'updateProfile'])->name('update');
    });

    Route::group(['prefix' => 'product-categories', 'as' => 'product_category.'], function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
        Route::get('datatable', [ProductCategoryController::class, 'datatable'])->name('datatable');
        Route::get('create', [ProductCategoryController::class, 'create'])->name('create');
        Route::post('store', [ProductCategoryController::class, 'store'])->name('store');
        Route::get('list', [ProductCategoryController::class, 'list'])->name('list');
        Route::get('edit/{product_category}', [ProductCategoryController::class, 'edit'])->name('edit');
        Route::patch('update/{product_category}', [ProductCategoryController::class, 'update'])->name('update');
        Route::patch('set-status/{product_category}/{status}', [ProductCategoryController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('datatable', [ProductController::class, 'datatable'])->name('datatable');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::patch('update/{product}', [ProductController::class, 'update'])->name('update');
        Route::patch('set-status/{product}/{status}', [ProductController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'expense-categories', 'as' => 'expense_category.'], function () {
        Route::get('/', [ExpenseCategoryController::class, 'index'])->name('index');
        Route::get('datatable', [ExpenseCategoryController::class, 'datatable'])->name('datatable');
        Route::post('store', [ExpenseCategoryController::class, 'store'])->name('store');
        Route::get('list', [ExpenseCategoryController::class, 'list'])->name('list');
        Route::get('edit/{expense_category}', [ExpenseCategoryController::class, 'edit'])->name('edit');
        Route::patch('update/{expense_category}', [ExpenseCategoryController::class, 'update'])->name('update');
        Route::patch('set-status/{expense_category}/{status}', [ExpenseCategoryController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('index');
        Route::get('datatable', [ExpenseController::class, 'datatable'])->name('datatable');
        Route::post('store', [ExpenseController::class, 'store'])->name('store');
        Route::get('edit/{expense}', [ExpenseController::class, 'edit'])->name('edit');
        Route::patch('update/{expense}', [ExpenseController::class, 'update'])->name('update');
        Route::patch('set-status/{expense}/{status}', [ExpenseController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('datatable', [CustomerController::class, 'datatable'])->name('datatable');
        Route::post('store', [CustomerController::class, 'store'])->name('store');
        Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
        Route::patch('update/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::patch('set-status/{customer}/{status}', [CustomerController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::get('datatable', [SupplierController::class, 'datatable'])->name('datatable');
        Route::post('store', [SupplierController::class, 'store'])->name('store');
        Route::get('edit/{supplier}', [SupplierController::class, 'edit'])->name('edit');
        Route::patch('update/{supplier}', [SupplierController::class, 'update'])->name('update');
        Route::patch('set-status/{supplier}/{status}', [SupplierController::class, 'setStatus'])->name('set_status');
    });

    Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
        Route::get('/', [SaleController::class, 'index'])->name('index');
        Route::get('datatable', [SaleController::class, 'datatable'])->name('datatable');
        Route::get('create', [SaleController::class, 'create'])->name('create');
        Route::post('store', [SaleController::class, 'store'])->name('store');
        Route::get('edit/{sale}', [SaleController::class, 'edit'])->name('edit');
        Route::patch('update/{sale}', [SaleController::class, 'update'])->name('update');
        Route::patch('set-status/{sale}/{status}', [SaleController::class, 'setStatus'])->name('set_status');
        Route::patch('set-payment-status/{sale}/{status}', [SaleController::class, 'setPaymentStatus'])->name('set_payment_status');
    });
});


Route::group(['prefix' => 'nasbdgg'], function () {
    // Login Routes...
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    
    // Logout Routes...
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    // // Registration Routes...
    // Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
    
    // // Password Reset Routes...
    // Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    // Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    
    // // Password Confirmation Routes...
    // Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    // Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);
    
    // // Email Verification Routes...
    // Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
    // Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    // Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
});
