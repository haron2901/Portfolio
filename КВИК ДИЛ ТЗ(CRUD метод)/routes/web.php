<?php

use App\Http\Controllers\TasksController;
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

Route::post('/api/create', [TasksController::class, 'create'])->name('tasks.create');

Route::post('/api/get', [TasksController::class, 'get'])->name('tasks.get');

Route::post('/api/getByDate', [TasksController::class, 'getByDate'])->name('tasks.getByDate');

Route::post('/api/edit', [TasksController::class, 'edit'])->name('tasks.edit');
