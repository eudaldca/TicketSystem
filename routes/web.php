<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('tickets', TicketController::class)->except(['edit']);
Route::resource('categories', CategoryController::class)->except('show');
Route::post('comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('permissions', [PermissionsController::class, 'download'])->name('permissions.download');
Route::post('permissions', [PermissionsController::class, 'upload'])->name('permissions.upload');

Route::prefix('datatables/')->name('datatables.')->group(function () {
    Route::get('tickets', [TicketController::class, 'datatable'])->name('tickets');
});
