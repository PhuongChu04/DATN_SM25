<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductController as AdminProductController;

use App\Http\Controllers\ADMIN\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use Faker\Guesser\Name;

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
    Route::get('/dashboard', [AdminController::class, 'homeAdmin'])->middleware('checkUser')->name('homeAdmin');
    Route::get('/list-product', [AdminProductController::class, 'list'])->middleware('checkAdmin')->name('listProduct');



    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'login'])->name('loginAdmin');//form đăng nhập
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLoginAdmin');
        Route::get('/register', [RoleController::class, 'createRole'])->name('createRole');//form tạo role
        Route::post('/create_role', [RoleController::class, 'postCreateRole'])->name('postCreateRole');
        Route::get('/attach-role', [RoleController::class, 'showAttachForm'])->name('attachRoleForm');//form gán quyền
        Route::post('/attach-role', [RoleController::class, 'attachUserRole'])->name('attachUserRole');
        
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logoutAdmin');
    });

    Route::prefix('/color')->name('color.')->group(function () {
        Route::get('/', [ColorController::class, 'list'])->name('listColor');
        Route::get('/list', [ColorController::class, 'list'])->name('listColor');
        Route::get('/add', [ColorController::class, 'create'])->name('addColor');
        Route::post('/store', [ColorController::class, 'store'])->name('storeColor');
        Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('editColor');
        Route::post('/update/{id}', [ColorController::class, 'update'])->name('updateColor');
        Route::get('/delete/{id}', [ColorController::class, 'destroy'])->name('deleteColor');
        Route::get('/bulk-delete', [ColorController::class, 'bulkDelete'])->name('bulkDeleteColor');
        Route::get('/trash', [ColorController::class, 'trash'])->name('trashColor');
        Route::get('/restore/{id}', [ColorController::class, 'restore'])->name('restoreColor');
        Route::get('/bulk-restore', [ColorController::class, 'bulkRestore'])->name('bulkRestoreColor');
        Route::delete('color/force-delete/{id}', [ColorController::class, 'forceDelete'])->name('forceDeleteColor');
        
    });

    Route::prefix('/size')->name('size.')->group(function () {
        Route::get('/', [SizeController::class, 'list'])->name('listSize');
        Route::get('/list', [SizeController::class, 'list'])->name('listSize');
        Route::get('/add', [SizeController::class, 'create'])->name('addSize'); 
        Route::post('/store', [SizeController::class, 'store'])->name('storeSize');
        Route::get('/edit/{id}', [SizeController::class, 'edit'])->name('editSize');
        Route::post('/update/{id}', [SizeController::class, 'update'])->name('updateSize');
        Route::get('/delete/{id}', [SizeController::class, 'destroy'])->name('deleteSize');
        Route::get('/trash', [SizeController::class, 'trash'])->name('trashSize');
        Route::get('/restore/{id}', [SizeController::class, 'restore'])->name('restoreSize');
        Route::delete('size/force-delete/{id}', [SizeController::class, 'forceDelete'])->name('forceDeleteSize');

        Route::get('/bulk-delete', [SizeController::class, 'bulkDelete'])->name('bulkDeleteSize');
        Route::get('/bulk-restore', [SizeController::class, 'bulkRestoreSize'])->name('bulkRestoreSize');

    });

    Route::prefix('/voucher')->name('voucher.')->group(function () {
        Route::get('/', [VoucherController::class, 'list'])->name('listVoucher');
        Route::get('/list', [VoucherController::class, 'list'])->name('listVoucher');
        Route::get('/add', [VoucherController::class, 'create'])->name('addVoucher'); 
        Route::post('/store', [VoucherController::class, 'store'])->name('storeVoucher');
        Route::get('/edit/{id}', [VoucherController::class, 'edit'])->name('editVoucher');
        Route::post('/update/{id}', [VoucherController::class, 'update'])->name('updateVoucher');
        Route::get('/delete/{id}', [VoucherController::class, 'destroy'])->name('deleteVoucher');
        Route::get('/trash', [VoucherController::class, 'trash'])->name('trashVoucher');
        Route::get('/restore/{id}', [VoucherController::class, 'restore'])->name('restoreVoucher');
        Route::delete('voucher/force-delete/{id}', [VoucherController::class, 'forceDelete'])->name('forceDeleteVoucher');

        Route::get('/bulk-delete', [VoucherController::class, 'bulkDelete'])->name('bulkDeleteVoucher');
        Route::get('/bulk-restore', [VoucherController::class, 'bulkRestore'])->name('bulkRestoreVoucher');
    });

});








//client
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'homeClient'])->name('homeClient');
    Route::get('/acc',[ClientController::class , 'account'])->middleware('checkLogin')->name('account');
     Route::get('/acc-detail',[AuthController::class , 'accountDetail'])->middleware('checkLogin')->name('accountDetail'); // show data
     Route::post('/account-detail', [AuthController::class, 'updateAccountDetail'])->middleware('checkLogin')->name('updateAccountDetail');

});
Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'login'])->name('loginClient');
    Route::get('/registerclient', [AuthController::class, 'register'])->name('registerClient');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLoginClient');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegisterClient');
    Route::get('/logout', [AuthController::class, 'logoutClient'])->middleware('checkLogin')->name('logoutClient');
});
