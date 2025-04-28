<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController as AdminProductController;
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



Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard',[AdminController::class , 'homeAdmin'])->name('homeAdmin');
    Route::get('/list-product',[AdminProductController::class , 'list'])->name('listProduct');
});



Route::prefix('client')->name('client.')->group(function (){
    Route::get('/dashboard',[ClientController::class, 'homeClient'] )->name('homeClient');
});
