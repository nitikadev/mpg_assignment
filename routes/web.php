<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('employee',[EmployeeController::class,'index']);
Route::post('storeemployee', [EmployeeController::class, 'store'])->name('storeemployee');
Route::get('getemployeebyid/{id}', [EmployeeController::class, 'show'])->name('getemployeebyid');
Route::get('deleteemployee/{id}', [EmployeeController::class, 'destroy'])->name('deleteemployee');

Route::match(['get','post'],'signin', [EmployeeController::class, 'checkUserAuth'])->name('signin');

Route::get('payment', [EmployeeController::class, 'paymentAction']);