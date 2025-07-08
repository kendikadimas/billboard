<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillboardController;
use App\Http\Controllers\ReportController;
use App\Livewire\SafetyDashboardManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama bisa diarahkan ke billboard
Route::get('/', [BillboardController::class, 'show']);

// Route untuk menampilkan Billboard
Route::get('/billboard', [BillboardController::class, 'show'])->name('billboard.show');

// Route untuk Admin Panel (lindungi dengan middleware auth jika perlu)
Route::get('/admin', SafetyDashboardManager::class)
    // ->middleware('auth') // Contoh jika menggunakan middleware otentikasi
    ->name('admin.safety.dashboard');

Route::get('/admin/report/excel', [ReportController::class, 'exportExcel'])->name('report.export.excel');
    Route::get('/admin/report/pdf', [ReportController::class, 'exportPdf'])->name('report.export.pdf');

// Route default dari Laravel Breeze/Jetstream jika ada
require __DIR__.'/auth.php';