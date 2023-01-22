<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::middleware('auth')->group(function (){
    /**
     * index page
     */
    Route::get('/', [HomeController::class, 'index'])->name('home');

    /**
     * users routes
     */
    Route::prefix('users')->name('users.')->group(function ()
    {
        Route::get('/' , [UserController::class , 'index'])->name('index');
        Route::post('/store' , [UserController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [UserController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [UserController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [UserController::class , 'destroy'])->name('delete');
    });

    /**
     * clients routes
     */
    Route::prefix('clients')->name('clients.')->group(function ()
    {
        Route::get('/' , [ClientController::class , 'index'])->name('index');
        Route::get('/show/{id}' , [ClientController::class , 'show'])->name('show');
        Route::post('/store' , [ClientController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [ClientController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [ClientController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [ClientController::class , 'destroy'])->name('delete');
    });

    /**
     * categories routes
     */
    Route::prefix('categories')->name('categories.')->group(function ()
    {
        Route::get('/' , [CategoryController::class , 'index'])->name('index');
        Route::post('/store' , [CategoryController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [CategoryController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [CategoryController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [CategoryController::class , 'destroy'])->name('delete');
    });

    /**
     * employees routes
     */
    Route::prefix('employees')->name('employees.')->group(function ()
    {
        Route::get('/' , [EmployeeController::class , 'index'])->name('index');
        Route::post('/store' , [EmployeeController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [EmployeeController::class , 'edit'])->name('edit');
        Route::get('/show/{id}' , [EmployeeController::class , 'show'])->name('show');
        Route::get('/search/{id}' , [EmployeeController::class , 'search'])->name('search');
        Route::put('/update/{id}' , [EmployeeController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [EmployeeController::class , 'destroy'])->name('delete');
    });

    /**
     * items routes
     */
    Route::prefix('items')->name('items.')->group(function ()
    {
        Route::get('/' , [ItemController::class , 'index'])->name('index');
        Route::post('/store' , [ItemController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [ItemController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [ItemController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [ItemController::class , 'destroy'])->name('delete');
        
        Route::get('export' , [ItemController::class ,'export'])->name('export');
    });

    /**
     * expenses routes
     */
    Route::prefix('expenses')->name('expenses.')->group(function ()
    {
        Route::get('/' , [ExpenseController::class , 'index'])->name('index');
        Route::post('/store' , [ExpenseController::class , 'store'])->name('store');
        Route::get('/edit/{id}' , [ExpenseController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [ExpenseController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [ExpenseController::class , 'destroy'])->name('delete');
    });

    /**
     * orders routes
     */
    Route::prefix('orders')->name('orders.')->group(function ()
    {
        Route::get('/' , [OrderController::class , 'index'])->name('index');
        Route::get('/archive' , [OrderController::class , 'archive'])->name('archive');
        Route::get('/create' , [OrderController::class , 'create'])->name('create');
        Route::post('/store' , [OrderController::class , 'store'])->name('store');
        Route::get('/show/{id}' , [OrderController::class , 'show'])->name('show');
        Route::get('/edit/{id}' , [OrderController::class , 'edit'])->name('edit');
        Route::put('/update/{id}' , [OrderController::class , 'update'])->name('update');
        Route::delete('/delete/{id}' , [OrderController::class , 'destroy'])->name('delete');
        Route::post('/change-status/{id}' , [OrderController::class , 'change_status'])->name('change_status');
        Route::get('/change-payment/{id}' , [OrderController::class , 'change_payment'])->name('change_payment');
        Route::get('/print/{id}' , [OrderController::class , 'print'])->name('print');
        Route::get('/asset/{id}' , [OrderController::class , 'asset'])->name('asset');
    });

    /**
     * ajax routes
     */
    Route::post('/ajax-client' , [AjaxController::class , 'client'])->name('ajax.client');
    Route::get('/ajax-items' , [AjaxController::class , 'items'])->name('ajax.items');
    Route::get('/ajax-prices' , [AjaxController::class , 'prices'])->name('ajax.prices');
    Route::post('/ajax-submit_item' , [AjaxController::class , 'submit_item'])->name('ajax.submit_item');

    /**
     * reports routes
     */
    Route::get('/reports' , [ReportController::class , 'index'])->name('reports');
    Route::get('/reports/search' , [ReportController::class , 'search'])->name('search');
    Route::get('/report/daily' , [ReportController::class , 'daily_report'])->name('reports.daily');
    Route::get('/reports/laundry-and-ironing' , [ReportController::class , 'report'])->name('reports.report');

    /**
     * attendances routes
     */
    Route::prefix('attendance')->name('attendance.')->group(function(){
        Route::get('/' , [AttendanceController::class , 'index'])->name('index');
        Route::post('/store' , [AttendanceController::class , 'store'])->name('store');
        Route::get('/show/{id}' ,[AttendanceController::class , 'show'])->name('show');
    });
});

