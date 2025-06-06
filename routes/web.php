<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

// =================================ADMIN=================================
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\CategoryController;

// =================================CLIENT=================================
use App\Http\Controllers\Client\ProductController as ClientProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'homeAdmin'])->name('homeAdmin');

    //              ==================   PRODUCTS =====================
    Route::prefix('list-product')->name('admin.')->group(function () {
        Route::get('/', [AdminProductController::class, 'list'])->name('listProduct');
        Route::get('/add', [AdminProductController::class, 'add'])->name('addProduct');
        Route::get('/update', [AdminProductController::class, 'update'])->name('updateProduct');
        Route::get('/delete', [AdminProductController::class, 'delete'])->name('deleteProduct');
    });

    //              ==================   CATEGORY =====================
    Route::prefix('listCategory')->name('admin.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('listCategory');
        // Route::get('/add', [AdminCategoryController::class, 'add'])->name('addCategory');
        // Route::get('/update', [AdminCategoryController::class, 'update'])->name('updateCategory');
        // Route::get('/delete', [AdminCategoryController::class, 'delete'])->name('deleteProduct');
    });
});



Route::prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'homeClient'])->name('homeClient');
});
