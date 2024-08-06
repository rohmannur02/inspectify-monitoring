<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefectController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResultProductionController;
use App\Http\Controllers\UserController;
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
    return view("pages.auth.login");
});


Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return redirect()->route('dashboard.index');
    })->name('home');

    Route::get('/profile', function () {
        return view("pages.profile");
    })->name('profile');
    
    Route::get('/standarisasi', function () {
        return view("pages.standarisasi");
    })->name('standarisasi');

    Route::resource('user', UserController::class);
    Route::resource('production', ResultProductionController::class);
    Route::resource('defect', DefectController::class);
    Route::resource('product', ProductController::class);
    Route::resource('dashboard', DashboardController::class);

    Route::get('/report-by-defect', [DefectController::class, 'reportByDefect'])->name('report.report_by_defect');
    Route::get('/view-customize-defect', [DefectController::class, 'viewCustomizeReportDefects'])->name('report.customize_defect');
    Route::get('/generate-customize-report', [DefectController::class, 'generateCustomizeReport'])->name('defect.generateCustomizeReport');
    Route::get('/export-customize-defect', [DefectController::class, 'exportExcelCustomizeDefect'])->name('export.customize_defect');
    Route::get('/export-defects', [DefectController::class, 'exportExcelDefects'])->name('export.defects');
});
