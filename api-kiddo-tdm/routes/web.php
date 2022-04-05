<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\StudentController;
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
    return view('welcome');
});

Auth::routes();

Route::get('responsibles', [ResponsibleController::class, 'view'])->name('responsibles');

Route::get('students', [StudentController::class, 'view'])->name('students');


Route::get('contracts', [ContractController::class, 'view'])->name('contracts');

