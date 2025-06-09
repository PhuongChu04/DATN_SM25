<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

// =================================ADMIN=================================
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;

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

    //              ==================  PRODUCTS =====================
    Route::prefix('listProduct')->name('listProduct.')->group(function () {
        Route::get('/', [AdminProductController::class, 'list'])->name('listProduct');
        Route::get('/add', [AdminProductController::class, 'add'])->name('addProduct');
        Route::get('/update', [AdminProductController::class, 'update'])->name('updateProduct');
        Route::get('/delete', [AdminProductController::class, 'delete'])->name('deleteProduct');
    });

    //              ==================  CATEGORY =====================
    Route::prefix('listCategory')->name('listCategory.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('list');

        Route::get('/detail/{id}', [AdminCategoryController::class, 'show'])->name('detailCategory');

        Route::get('/add', [AdminCategoryController::class, 'create'])->name('addCategory');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('storeCategory');

        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('editCategory');
        Route::put('/update{id}', [AdminCategoryController::class, 'update'])->name('updateCategory');

        Route::delete('/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('deleteCategory');
        Route::get('/search', [AdminCategoryController::class, 'search'])->name('searchCategory');

    });
});



Route::prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'homeClient'])->name('homeClient');
});
