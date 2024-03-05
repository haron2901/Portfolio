<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/employee', function (){
   return view('employee');
});


Route::post('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/delete', [EmployeeController::class, 'delete']);
Route::post('/employees/putRevenue', [EmployeeController::class, 'putRevenue']);
Route::get('/employees/search', [EmployeeController::class, 'searchByName']);




Route::post('/client/create', [ClientController::class, 'create']);

Route::post('/inventory/create', [InventoryController::class, 'create']);
Route::post('/inventory/delete', [InventoryController::class, 'delete']);
Route::post('/inventory/update', [InventoryController::class, 'update']);

Route::post('/rent/create', [RentController::class, 'create']);
Route::get('/Rent', [InventoryController::class, 'getAllFree'])->name('getAllFree');


