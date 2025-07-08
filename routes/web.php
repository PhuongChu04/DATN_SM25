<?php

use App\Http\Controllers\admin\AdminController;

// =================================ADMIN=================================
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ADMIN\AuthController as AdminAuthController;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ShippingRateController;
use App\Http\Controllers\Client\HomeContrller;
// =================================CLIENT=================================

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
    Route::get('/dashboard', [AdminController::class, 'homeAdmin'])->name('homeAdmin');

    // Route::get('/dashboard', [AdminController::class, 'homeAdmin'])->middleware('checkUser')->name('homeAdmin');
    // Route::get('/list-product', [AdminProductController::class, 'list'])->middleware('checkAdmin')->name('listProduct');
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::get('/order-details', [OrderController::class, 'details'])->name('order.details');
    Route::post('/order/update-status/{id}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/refund', [OrderController::class, 'refund'])->name('orders.refund');
    Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');
    Route::resource('order-details', \App\Http\Controllers\Admin\OrderDetailController::class)->only(['index', 'store', 'destroy']);


    // Product

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/list-product', [AdminProductController::class, 'list'])->name('listProduct');
        Route::get('/add', [AdminProductController::class, 'create'])->name('create');
        Route::post('/postCreate', [AdminProductController::class, 'postCreate'])->name('postCreate');
        Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminProductController::class, 'postEdit'])->name('postEdit');
        Route::get('/detail/{id}', [AdminProductController::class, 'detail'])->name('detail');
        Route::get('/show/{id}', [AdminProductController::class, 'show'])->name('show');
        Route::get('/delete/{id}', [AdminProductController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [AdminProductController::class, 'trash'])->name('trash');
        Route::get('/restore/{id}', [AdminProductController::class, 'restore'])->name('restore');
        Route::get('/force-delete/{id}', [AdminProductController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/bulk-delete', [AdminProductController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-restore', [AdminProductController::class, 'bulkRestore'])->name('bulkRestore');
        // phần search
        Route::get('/search', [AdminProductController::class, 'search'])->name('search');
    });
    


    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'login'])->name('loginAdmin'); //form đăng nhập
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLoginAdmin');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logoutAdmin');

        Route::get('/list', [UserController::class, 'list'])->name('list');

        Route::get('/register', [RoleController::class, 'createRole'])->name('createRole'); //form tạo role
        Route::post('/create_role', [RoleController::class, 'postCreateRole'])->name('postCreateRole');
        Route::get('/attach-role', [RoleController::class, 'showAttachForm'])->name('attachRoleForm'); //form gán quyền
        Route::post('/attach-role', [RoleController::class, 'attachUserRole'])->name('attachUserRole');
    });

    Route::prefix('/color')->name('color.')->group(function () {
        // Route::get('/', [ColorController::class, 'list'])->name('listColor');
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
        Route::get('/force-delete/{id}', [ColorController::class, 'forceDelete'])->name('forceDeleteColor');
    });

    Route::prefix('/size')->name('size.')->group(function () {
        // Route::get('/', [SizeController::class, 'list'])->name('listSize');
        Route::get('/list', [SizeController::class, 'list'])->name('listSize');
        Route::get('/add', [SizeController::class, 'create'])->name('addSize');
        Route::post('/store', [SizeController::class, 'store'])->name('storeSize');
        Route::get('/edit/{id}', [SizeController::class, 'edit'])->name('editSize');
        Route::post('/update/{id}', [SizeController::class, 'update'])->name('updateSize');
        Route::get('/delete/{id}', [SizeController::class, 'destroy'])->name('deleteSize');
        Route::get('/trash', [SizeController::class, 'trash'])->name('trashSize');
        Route::get('/restore/{id}', [SizeController::class, 'restore'])->name('restoreSize');
        Route::get('/force-delete/{id}', [SizeController::class, 'forceDelete'])->name('forceDeleteSize');

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
        Route::get('/force-delete/{id}', [VoucherController::class, 'forceDelete'])->name('forceDeleteVoucher');

        Route::get('/bulk-delete', [VoucherController::class, 'bulkDelete'])->name('bulkDeleteVoucher');
        Route::get('/bulk-restore', [VoucherController::class, 'bulkRestore'])->name('bulkRestoreVoucher');
    });
});


Route::prefix('user')->name('user.')->group(function () {
    Route::get('/create', [UserController::class, 'createUser'])->name('createUser');
    Route::get('/update/{id}', [UserController::class, 'userDetail'])->name('userDetail');

    Route::post('/register-user', [UserController::class, 'postRegister'])->name('postRegister');
    Route::get('/account-detail/{id}', [UserController::class, 'accountDetail'])->name('accountDetail');
    Route::post('/update-user/{id}', [UserController::class, 'updateAccountDetail'])->name('updateAccountDetail');
    Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
});

//             ==================  CATEGORY =====================
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
//brand

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');

    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

    Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Shipping routes
    Route::get('/shippings', [ShippingController::class, 'index'])->name('shippings.index');
    Route::get('/shippings/create', [ShippingController::class, 'create'])->name('shippings.create');
    Route::post('/shippings', [ShippingController::class, 'store'])->name('shippings.store');
    Route::get('/shippings/{shipping}/edit', [ShippingController::class, 'edit'])->name('shippings.edit');
    Route::put('/shippings/{shipping}', [ShippingController::class, 'update'])->name('shippings.update');
    Route::delete('/shippings/{shipping}', [ShippingController::class, 'destroy'])->name('shippings.destroy');

    // Shipping Rates routes
    Route::get('/shipping-rates', [ShippingRateController::class, 'index'])->name('shipping-rates.index');
    Route::get('/shipping-rates/create', [ShippingRateController::class, 'create'])->name('shipping-rates.create');
    Route::post('/shipping-rates', [ShippingRateController::class, 'store'])->name('shipping-rates.store');
    Route::get('/shipping-rates/{shippingRate}/edit', [ShippingRateController::class, 'edit'])->name('shipping-rates.edit');
    Route::put('/shipping-rates/{shippingRate}', [ShippingRateController::class, 'update'])->name('shipping-rates.update');
    Route::delete('/shipping-rates/{shippingRate}', [ShippingRateController::class, 'destroy'])->name('shipping-rates.destroy');
});

//client
Route::prefix('client')->name('client.')->group(function () {
    // Route::get('/dashboard', [ClientController::class, 'homeClient'])->name('homeClient'); 

    Route::get('/dashboard', [ClientProductController::class, 'index'])->name('home');
    Route::get('/dashboard/list', [ClientProductController::class, 'listProducts'])->name('listProducts');

    Route::get('/acc', [ClientController::class, 'account'])->middleware('checkLogin')->name('account');
    Route::get('/acc-detail', [AuthController::class, 'accountDetail'])->middleware('checkLogin')->name('accountDetail'); // show data
    Route::post('/account-detail', [AuthController::class, 'updateAccountDetail'])->middleware('checkLogin')->name('updateAccountDetail');

   
});
Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'login'])->name('loginClient');
    Route::get('/registerclient', [AuthController::class, 'register'])->name('registerClient');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLoginClient');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegisterClient');
    Route::get('/logout', [AuthController::class, 'logoutClient'])->middleware('checkLogin')->name('logoutClient');
});
