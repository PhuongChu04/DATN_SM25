<?php

use App\Http\Controllers\admin\AdminController;

// =================================ADMIN=================================
use App\Http\Controllers\admin\ProductController as AdminProductController;

use App\Http\Controllers\ADMIN\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ShippingRateController;

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
    Route::get('/dashboard', [AdminController::class, 'homeAdmin'])->middleware('checkUser')->name('homeAdmin');
    Route::get('/list-product', [AdminProductController::class, 'list'])->middleware('checkAdmin')->name('listProduct');
     Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/update-status/{id}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');




    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'login'])->name('loginAdmin'); //form đăng nhập
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('postLoginAdmin');
        Route::get('/register', [RoleController::class, 'createRole'])->name('createRole'); //form tạo role
        Route::post('/create_role', [RoleController::class, 'postCreateRole'])->name('postCreateRole');
        Route::get('/attach-role', [RoleController::class, 'showAttachForm'])->name('attachRoleForm'); //form gán quyền
        Route::post('/attach-role', [RoleController::class, 'attachUserRole'])->name('attachUserRole');

        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logoutAdmin');
    });
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


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
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
    Route::get('/dashboard', [ClientController::class, 'homeClient'])->name('homeClient');
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
