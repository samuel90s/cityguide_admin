<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TransportationController;

use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// destinations
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::prefix('destinations')->name('destinations.')->group(function () {
        Route::get('/', [DestinationController::class, 'index'])->name('index');
        Route::get('/create', [DestinationController::class, 'create'])->name('create');
        Route::post('/', [DestinationController::class, 'store'])->name('store');
        Route::get('/{destination}', [DestinationController::class, 'show'])->name('show');
        Route::get('/{destination}/edit', [DestinationController::class, 'edit'])->name('edit');
        Route::put('/{destination}', [DestinationController::class, 'update'])->name('update');
        Route::delete('/{destination}', [DestinationController::class, 'destroy'])->name('destroy');
    });
    // accomodations
    Route::prefix('accommodations')->name('accommodations.')->group(function () {
        Route::get('/', [AccommodationController::class, 'index'])->name('index');
        Route::get('/create', [AccommodationController::class, 'create'])->name('create');
        Route::post('/', [AccommodationController::class, 'store'])->name('store');
        Route::get('/{accommodation}', [AccommodationController::class, 'show'])->name('show');
        Route::get('/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('edit');
        Route::put('/{accommodation}', [AccommodationController::class, 'update'])->name('update');
        Route::delete('/{accommodation}', [AccommodationController::class, 'destroy'])->name('destroy');
    });
    // events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{event}', [EventController::class, 'show'])->name('show');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
    });
    // trasnportation
    Route::prefix('transportations')->name('transportations.')->group(function () {
        Route::get('/', [TransportationController::class, 'index'])->name('index');
        Route::get('/create', [TransportationController::class, 'create'])->name('create');
        Route::post('/', [TransportationController::class, 'store'])->name('store');
        Route::get('/{transportation}/edit', [TransportationController::class, 'edit'])->name('edit');
        Route::put('/{transportation}', [TransportationController::class, 'update'])->name('update');
        Route::delete('/{transportation}', [TransportationController::class, 'destroy'])->name('destroy');
    });
});



require __DIR__.'/auth.php';
