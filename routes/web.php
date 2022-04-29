<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('tickets', TicketController::class)->except(['edit']);
Route::resource('categories', CategoryController::class);
Route::post('comment', [CommentController::class, 'store'])->name('comments.store');

Route::prefix('datatables/')->name('datatables.')->group(function () {
    Route::get('tickets', [TicketController::class, 'datatable'])->name('tickets');
});
