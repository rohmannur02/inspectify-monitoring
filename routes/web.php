<?php

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

    Route::resource('user', UserController::class);
    Route::resource('production', \App\Http\Controllers\ResultProductionController::class);
    Route::resource('defect', \App\Http\Controllers\DefectController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);

    Route::get('/report-by-defect', [\App\Http\Controllers\DefectController::class, 'reportByDefect'])->name('report.report_by_defect');
    Route::get('/view-customize-defect', [\App\Http\Controllers\DefectController::class, 'viewCustomizeReportDefects'])->name('report.customize_defect');
    Route::get('/generate-customize-report', [\App\Http\Controllers\DefectController::class, 'generateCustomizeReport'])->name('defect.generateCustomizeReport');
    Route::get('/export-customize-defect', [\App\Http\Controllers\DefectController::class, 'exportExcelCustomizeDefect'])->name('export.customize_defect');
    Route::get('/export-defects', [\App\Http\Controllers\DefectController::class, 'exportExcelDefects'])->name('export.defects');
});