<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('tickets', TicketController::class)->except(['edit']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('comments', CommentController::class)->name('store', 'comments.store');

Route::prefix('datatables/')->name('datatables.')->group(function () {
    Route::get('tickets', [TicketController::class, 'datatable'])->name('tickets');
});
