<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeginnersClassController;
use App\Http\Controllers\BaptismController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DedicationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TmaController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');


    //TMA
    Route::get('/tmas', [TmaController::class, 'index'])->name('tmas.index');
    Route::get('/tmas/create', [TmaController::class, 'create'])->name('tmas.create');
    Route::post('/tmas', [TmaController::class, 'store'])->name('tmas.store');
    Route::get('/tmas/{id}/edit', [TmaController::class, 'edit'])->name('tmas.edit');
    Route::put('/tmas/{id}', [TmaController::class, 'update'])->name('tmas.update');
    Route::delete('/tmas/{id}', [TmaController::class, 'destroy'])->name('tmas.destroy');


    //BC
    Route::get('/beginners', [BeginnersClassController::class, 'index'])->name('bc.index');
    Route::get('/beginners/create', [BeginnersClassController::class, 'create'])->name('bc.create');
    Route::post('/beginners', [BeginnersClassController::class, 'store'])->name('bc.store');
    Route::get('/beginners/{id}/edit', [BeginnersClassController::class, 'edit'])->name('bc.edit');
    Route::put('/beginners/{id}', [BeginnersClassController::class, 'update'])->name('bc.update');
    Route::delete('/beginners/{id}', [BeginnersClassController::class, 'destroy'])->name('bc.destroy');
    Route::get('/beginners/{beginner}/print', [BeginnersClassController::class, 'print'])->name('bc.print');



    //Baptism
    Route::get('/baptism', [BaptismController::class, 'index'])->name('baptism.index');
    Route::get('/baptism/create', [BaptismController::class, 'create'])->name('baptism.create');
    Route::post('/baptism', [BaptismController::class, 'store'])->name('baptism.store');
    Route::get('/baptism/{id}/edit', [BaptismController::class, 'edit'])->name('baptism.edit');
    Route::put('/baptism{id}', [BaptismController::class, 'update'])->name('baptism.update');
    Route::delete('/baptism/{id}', [BaptismController::class, 'destroy'])->name('baptism.destroy');
    Route::get('/baptism/{baptism}/print', [BaptismController::class, 'print'])->name('baptism.print');


    //dedications
    Route::get('/dedications/{id}/print', [DedicationController::class, 'print'])->name('dedications.print');
    Route::resource('dedications', DedicationController::class);


    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/store', [PosController::class, 'store'])->name('pos.store');
    Route::get('/pos/getData', [PosController::class, 'getData'])->name('pos.getData');
    Route::post('/pos/create-user', [PosController::class, 'createUserWithRoleZero'])->name('pos.userCreate');
    Route::get("/dashboard/guest", [GuestController::class, 'index'])->name('guest.index');


    //calendar

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/print', [CalendarController::class, 'print'])->name('calendar.print');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/report/attendance', [ReportController::class, 'generateAttendanceReport'])->name('report.attendance');

});





require __DIR__.'/auth.php';
