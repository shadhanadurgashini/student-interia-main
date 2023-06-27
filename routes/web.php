<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

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

//Home
Route::get('/', [HomeController::class, "index"])->name('dashboard');

//Route created for the student entry
Route::prefix('/student')->group(function () {
        Route::get('/', [StudentController::class, "index"])->name('student');
        Route::get('/list', [StudentController::class, "list"])->name('student.list');
        Route::get('/{student_id}/get', [StudentController::class, "get"])->name('student.get');
        Route::post('/create', [StudentController::class, "create"])->name('student.create');
        Route::get('/edit', [StudentController::class, "edit"])->name('student.edit');
        Route::post('/{student_id}/update', [StudentController::class, "update"])->name('student.update');
        Route::delete('/{student_id}/delete', [StudentController::class, 'delete'])->name('student.delete');
        Route::get('/{student_id}/active', [StudentController::class, 'active'])->name('student.active');
});

require __DIR__.'/auth.php';
