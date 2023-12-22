<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DiscountPolicyController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StoreController;
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
  return redirect()->route('login');
})->name('home');

//Route::get('/', function () {
//  return view('site.index');
//})->name('home');
//


Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
  Route::get('/profile', [AdminController::class, 'profile'])->name('profile.show');
  Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
  Route::post('/password/update', [AdminController::class, 'passwordUpdate'])->name('password.update');

  Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('/permission-by-role', [PermissionController::class, 'getPermissionByRole'])->middleware('role_or_permission:Super Admin|Admin|Manage Permission')->name('get.permission.by.role');
    Route::post('/update/user/status', [UserController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage User')->name('update.user.status');
  });

#Users
  Route::prefix('user')->name('user.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->middleware('role_or_permission:Super Admin|Create User')->name('create');
    Route::post('/store', [UserController::class, 'store'])->middleware('role_or_permission:Super Admin|Create User|Manage User')->name('store');
    Route::get('/manage/{id}', [UserController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage User')->name('manage');
    Route::get('/{id}/view', [UserController::class, 'view'])->middleware('role_or_permission:Super Admin|View User')->name('view');
    Route::delete('/destroy', [UserController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete User')->name('destroy');
    Route::get('/list', [UserController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of User')->name('list');
    Route::get('/customer_list', [CustomerController::class, 'index'])->name('data');
    

  });
#Brand
  Route::prefix('brand')->name('brand.')->group(function () {

    Route::get('/create',[BrandController::class,'create_brand'])->name('create');
    Route::get('/list',[BrandController::class,'brand_list'])->name('list');
    Route::post('/store_data',[BrandController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[BrandController::class,'manage'])->name('manage');
    Route::delete('/destroy', [BrandController::class, 'destroy'])->name('destroy');
  });

  #Customers
  Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/create', [CustomerController::class, 'create'])->middleware('role_or_permission:Super Admin|Cashier|Create Customer')->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->middleware('role_or_permission:Super Admin|Cashier|Create Customer|Manage Customer')->name('store');
    Route::get('/manage/{id}', [CustomerController::class, 'manage'])->middleware('role_or_permission:Super Admin|Cashier|Manage Customer')->name('manage');
    Route::delete('/destroy', [CustomerController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Cashier|Delete Customer')->name('destroy');
    Route::get('/list', [CustomerController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Customer')->name('list');
  });

  #Measurements
  Route::prefix('measurement')->name('measurement.')->group(function () {
    Route::get('/create', [MeasurementController::class, 'create'])->middleware('role_or_permission:Super Admin|Cashier|Create Measurement')->name('create');
    Route::post('/store', [MeasurementController::class, 'store'])->middleware('role_or_permission:Super Admin|Cashier|Create Measurement|Manage Measurement')->name('store');
    Route::get('/manage/{id}', [MeasurementController::class, 'manage'])->middleware('role_or_permission:Super Admin|Cashier|Manage Measurement')->name('manage');
    Route::delete('/destroy', [MeasurementController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Cashier|Delete Measurement')->name('destroy');
    Route::get('/list', [MeasurementController::class, 'index'])->middleware('role_or_permission:Super Admin|Cashier|List Of Measurement')->name('list');
  });
  #Categories
  Route::prefix('categories')->name('categories.')->group(function () {

    Route::get('/create',[CategoriesController::class,'create_categories'])->name('create');
    Route::get('/list',[CategoriesController::class,'categories_list'])->name('list');
    Route::post('/store_data',[CategoriesController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[CategoriesController::class,'manage'])->name('manage');
    Route::delete('/destroy', [CategoriesController::class, 'destroy'])->name('destroy');
  });

  #Sub-Categories
  Route::prefix('sub-categories')->name('sub-categories.')->group(function () {

    Route::get('/create',[SubCategoriesController::class,'create_subcategories'])->name('create');
    Route::get('/list',[SubCategoriesController::class,'subcategories_list'])->name('list');
    Route::post('/store_data',[SubCategoriesController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[SubCategoriesController::class,'manage'])->name('manage');
    Route::delete('/destroy', [SubCategoriesController::class, 'destroy'])->name('destroy');
  });

  #DiscountPolicy
  Route::prefix('discount')->name('discount.')->group(function () {

    Route::get('/create',[DiscountPolicyController::class,'create_discount'])->name('create');
    Route::get('/list',[DiscountPolicyController::class,'discount_list'])->name('list');
    Route::post('/store_data',[DiscountPolicyController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[DiscountPolicyController::class,'manage'])->name('manage');
    Route::delete('/destroy', [DiscountPolicyController::class, 'destroy'])->name('destroy');
  });

  #Suppliers
  Route::prefix('supplier')->name('supplier.')->group(function () {

    Route::get('/create',[SupplierController::class,'create_supplier'])->name('create');
    Route::get('/list',[SupplierController::class,'supplier_list'])->name('list');
    Route::post('/store_data',[SupplierController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[SupplierController::class,'manage'])->name('manage');
    Route::delete('/destroy', [SupplierController::class, 'destroy'])->name('destroy');
  });

  #Store
  Route::prefix('store')->name('store.')->group(function () {

    Route::get('/create',[StoreController::class,'create_store'])->name('create');
    Route::get('/list',[StoreController::class,'store_list'])->name('list');
    Route::post('/store_data',[StoreController::class,'store_data'])->name('store');
    Route::get('/manage/{id}',[StoreController::class,'manage'])->name('manage');
    Route::delete('/destroy', [StoreController::class, 'destroy'])->name('destroy');
  });

  #inventory
  Route::prefix('inventory')->name('inventory.')->group(function () {

    Route::get('/create',[InventoryController::class,'create_inventory'])->name('create');
    Route::get('/list',[InventoryController::class,'inventory_list'])->name('list');
    Route::post('/store_data',[InventoryController::class,'store'])->name('store');
    Route::get('/manage/{id}',[InventoryController::class,'manage'])->name('manage');
    Route::delete('/destroy', [InventoryController::class, 'destroy'])->name('destroy');
  });

  #Roles
  Route::prefix('role')->name('role.')->group(function () {
    Route::get('/create', [RoleController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Role')->name('create');
    Route::post('/store', [RoleController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Role|Manage Role')->name('store');
    Route::get('/manage/{id}', [RoleController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Role')->name('manage');
    Route::get('/{id}/view', [RoleController::class, 'view'])->middleware('role_or_permission:Super Admin|View Role')->name('view');
    Route::delete('/destroy', [RoleController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Role')->name('destroy');
    Route::get('/list', [RoleController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Role')->name('list');
  });

  #product
  Route::prefix('product')->name('product.')->group(function () {

    Route::get('/create',[ProductController::class,'create'])->middleware('role_or_permission:Super Admin|Cashier|Create Product')->name('create');
    Route::get('/list',[ProductController::class,'index'])->middleware('role_or_permission:Super Admin|Cashier|Create Product')->name('list');
    Route::post('/store',[ProductController::class,'store'])->middleware('role_or_permission:Super Admin|Cashier|Create Product')->name('store');
   // Route::get('/manage/{id}',[InventoryController::class,'manage'])->name('manage');
   // Route::delete('/destroy', [InventoryController::class, 'destroy'])->name('destroy');
  });


  #Permission
  Route::match(['get', 'post'], '/permission/manage', [PermissionController::class, 'managePermission'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('permission.manage');

});
