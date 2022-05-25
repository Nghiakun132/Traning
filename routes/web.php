<?php

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
// đăng nhập
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'loginPost']);
//Quản lý sản phẩm
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/add-product', [\App\Http\Controllers\ProductController::class, 'create'])->name('add-product');
Route::post('/add-product', [\App\Http\Controllers\ProductController::class, 'store'])->name('add-product');
Route::get('/edit-product/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('edit-product');
Route::post('/edit-product/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('edit-product');
Route::get('/delete-product/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('delete-product');
//tìm kiếm sản phẩm
Route::post('/search-product', [\App\Http\Controllers\ProductController::class, 'search'])->name('search-product');
//Quản lý khách hàng
Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
Route::post('/customers', [\App\Http\Controllers\CustomerController::class, 'store'])->name('add-customer');
Route::get('/delete-customer/{id}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('delete-customer');
//export khách hàng
Route::post('import-customer', [\App\Http\Controllers\CustomerController::class, 'importCustomer'])->name('import-customer');
Route::get('/export-customer', [\App\Http\Controllers\CustomerController::class, 'exportCustomer'])->name('export-customer');
//Tìm kiếm khách hàng
Route::get('/search-customer', [\App\Http\Controllers\CustomerController::class, 'search'])->name('search-customer');
//Quản lý users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('add-user');
Route::get('/delete-user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');
//lock user
Route::get('/active-user/{id}', [\App\Http\Controllers\UserController::class, 'active'])->name('active-user');
Route::get('search-user', [\App\Http\Controllers\UserController::class, 'search'])->name('search-user');
