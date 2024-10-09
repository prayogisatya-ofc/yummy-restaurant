<?php

use App\Http\Controllers\Backend\ChefController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, '__invoke'])->name('home');

Route::post('booking', [BookingController::class, 'store'])->name('booking');

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('panel.dashboard');

    Route::resource('images', ImageController::class)->names('panel.images');
    Route::resource('menus', MenuController::class)->names('panel.menus');
    Route::resource('chefs', ChefController::class)->names('panel.chefs');
    Route::resource('events', EventController::class)->names('panel.events');
});

Auth::routes();