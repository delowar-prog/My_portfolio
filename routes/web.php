<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[ProjectController::class,'index'])->name('projects.index');
Route::get('/create',[ProjectController::class,'create'])->name('projects.create');
Route::post('/projects/store',[ProjectController::class,'store'])->name('projects.store');
Route::get('/projects/show/{id}',[ProjectController::class,'show']);
Route::get('/projects/edit/{id}',[ProjectController::class,'edit']);
Route::post('/projects/update/{id}',[ProjectController::class,'update']);
Route::get('/projects/delete/{id}',[ProjectController::class,'destroy']);