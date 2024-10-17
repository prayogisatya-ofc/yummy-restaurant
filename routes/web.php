<?php

use App\Http\Controllers\Backend\ChefController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, '__invoke'])->name('home');

Route::post('booking', [BookingController::class, 'store'])->name('booking');
Route::post('review', [ReviewController::class, 'store'])->name('review');

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('panel.dashboard');

    Route::resource('images', ImageController::class)->names('panel.images')->except('show');
    Route::resource('menus', MenuController::class)->names('panel.menus');
    Route::resource('chefs', ChefController::class)->names('panel.chefs');
    Route::resource('events', EventController::class)->names('panel.events');
    Route::resource('videos', VideoController::class)->names('panel.videos');
    Route::resource('reviews', BackendReviewController::class)->names('panel.reviews')->except('create', 'store', 'edit', 'update');
    Route::resource('transactions', TransactionController::class)->names('panel.transactions')->except('create', 'store', 'edit');
    Route::post('transactions/download', [TransactionController::class, 'download'])->name('panel.transactions.download');
});

Auth::routes();