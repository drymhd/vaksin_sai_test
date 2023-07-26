<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\FaskesController;
use App\Http\Controllers\FaskesVaksinController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\UserController;

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



Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/', 'login')->name('login');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

Route::resource('provinsi', ProvinsiController::class)->middleware('auth');
Route::resource('kota', KotaController::class)->middleware('auth');
Route::resource('vaksin', VaksinController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');

Route::prefix('faskes')->group(function(){
    Route::get('{faskes}/kuota', [FaskesController::class, 'kuota'])->name('faskes.kuota.index');
    Route::get('{faskes}/kuota/create', [FaskesVaksinController::class, 'create'])->name('faskes.kuota.create');
    Route::post('{faskes}/kuota/store', [FaskesVaksinController::class, 'store'])->name('faskes.kuota.store');
    Route::get('{faskes}/kuota/edit', [FaskesVaksinController::class, 'edit'])->name('faskes.kuota.edit');
    Route::put('{faskes}/kuota/update', [FaskesVaksinController::class, 'update'])->name('faskes.kuota.update');
})->middleware('auth');

Route::resource('faskes', FaskesController::class)->middleware('auth');


