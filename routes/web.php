<?php

use App\Http\Controllers\BeginnersClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TMAController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
    Route::get('/tmas', [TMAController::class, 'index'])->name('tmas.index');
    Route::get('/tmas/create', [TMAController::class, 'create'])->name('tmas.create');
    Route::post('/tmas', [TMAController::class, 'store'])->name('tmas.store');
    Route::get('/tmas/{id}/edit', [TMAController::class, 'edit'])->name('tmas.edit');
    Route::put('/tmas/{id}', [TMAController::class, 'update'])->name('tmas.update');
    Route::delete('/tmas/{id}', [TMAController::class, 'destroy'])->name('tmas.destroy');

    //BC
    Route::get('/beginners', [BeginnersClassController::class, 'index'])->name('bc.index');
    Route::get('/beginners/create', [BeginnersClassController::class, 'create'])->name('bc.create');
    Route::post('/beginners', [BeginnersClassController::class, 'store'])->name('bc.store');
    Route::get('/beginners/{id}/edit', [BeginnersClassController::class, 'edit'])->name('bc.edit');
    Route::put('/beginners/{id}', [BeginnersClassController::class, 'update'])->name('bc.update');
    Route::delete('/beginners/{id}', [BeginnersClassController::class, 'destroy'])->name('bc.destroy');






});





require __DIR__.'/auth.php';
