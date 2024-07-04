<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

Route::middleware('IsLogin', 'IsAdmin')->group(function() {
    Route::get('/home', function () {
    return view('home');
})->name('home.page');

    route::prefix('/medicine')->name('medicine.')->group(function(){
        route::get('/create', [MedicineController::class, 'create'])->name('create');
        route::post('/store', [MedicineController::class, 'store'])->name('store');
        route::get('/', [MedicineController::class, 'index'])->name('home');
        route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
        route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
        route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
        route::get('/data/stock', [MedicineController::class, 'stock'])->name('stock');
        route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
        route::patch('/data/stock/{id}', [MedicineController::class, 'stockUpdate'])->name('stock.update');
    });
    
    route::prefix('/user')->name('user.')->group(function(){
            route::get('/', [UserController::class, 'index'])->name('home');
        route::get('/create', [UserController::class, 'create'])->name('create');
        route::post('/store', [UserController::class, 'store'])->name('store');
        route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        route::patch('/{id}', [UserController::class, 'update'])->name('update');
        route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
        // route::get('/data/stock', [MedicineController::class, 'stock'])->name('stock');
        // route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
        // route::patch('/data/stock/{id}', [MedicineController::class, 'stockUpdate'])->name('stock.update');
    });
});

Route::prefix('/order')->name('order.')->group(function() {
    Route::get('/data', [OrderController::class, 'data'])->name('data');
    Route::get('/export-excel', [OrderController::class, 'exportExcel'])->name('export-excel');
});

Route::middleware(['IsLogin', 'IsKasir'])->group(function() {
    Route::prefix('/kasir')->name('kasir.')->group(function() {
        Route::prefix('/order')->name('order.')->group(function() {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/print/{id}', [OrderController::class, 'show'])->name('print');   
            Route::get('/download/{id}', [OrderController::class, 'downloadPDF'])->name('download');
        });
    });
});

Route::middleware('IsLogin')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');
});

Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');


