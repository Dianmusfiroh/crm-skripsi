<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\SettingAlarmController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TugasController;
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
    return redirect('/dashboard');
});

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', HomeController::class);
    Route::resource('divisi', DivisiController::class);
    Route::resource('projek', ProjekController::class);
    Route::resource('perangkat',PerangkatController::class);
    Route::resource('anggota',AnggotaController::class);
    Route::resource('tugas',TugasController::class);
    Route::resource('laporan',LaporanController::class);
    Route::resource('tim',TimController::class);
    Route::resource('broadcast',BroadcastController::class);
    Route::resource('setting-alarm',SettingAlarmController::class);
    Route::get('/generate-pdf/{id}', [LaporanController::class, 'generatePDF'])->name('generatePDF');
    
    Route::get('/send', [BroadcastController::class, 'send'])->name('send');
    Route::get('/toProses', [TugasController::class, 'toProses'])->name('toProses');
    Route::get('/toVerif', [TugasController::class, 'toVerif'])->name('toVerif');
    Route::get('/toSelesai', [TugasController::class, 'toSelesai'])->name('toSelesai');
    Route::get('/count_proses', [TugasController::class, 'count_proses'])->name('count_proses');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
