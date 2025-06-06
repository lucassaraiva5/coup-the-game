<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartnerStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/jogo', [GameController::class, 'jogo'])->name('game');

// Public access to view partner stores and events
Route::get('/partner-stores', [PartnerStoreController::class, 'index'])->name('partner-stores.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Protected routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Protected CRUD routes
    Route::resource('cards', CardController::class);
    
    // Events routes (except index which is public)
    Route::resource('events', EventController::class)->except(['index']);
    
    // Partner Stores routes (except index which is public)
    Route::resource('partner-stores', PartnerStoreController::class)->except(['index']);
    
    // Reviews are fully protected
    Route::resource('reviews', ReviewController::class);
});

require __DIR__.'/auth.php';
