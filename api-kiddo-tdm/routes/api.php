<?php

use App\Http\Controllers\ClassGroupController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('contracts', ContractController::class);


Route::apiResource('students', StudentController::class);


Route::apiResource('teachers', TeacherController::class);


Route::apiResource('courses', CourseController::class);


Route::apiResource('filials', FilialController::class);


Route::apiResource('rooms', RoomController::class);


Route::apiResource('class-groups', ClassGroupController::class);


Route::apiResource('responsibles', ResponsibleController::class);


Route::apiResource('images', ImageController::class);















