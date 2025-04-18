<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;


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

Route::get('/', [UploadController::class, 'showForm'])->name('upload.form');
Route::post('/upload', [UploadController::class, 'upload'])->name('upload.upload');
Route::get('/upload/success/{uuid}', [UploadController::class, 'success'])->name('upload.success');
Route::get('/download/{uuid}', [UploadController::class, 'downloadForm'])->name('upload.download.form');
Route::post('/download/{uuid}', [UploadController::class, 'download'])->name('upload.download');