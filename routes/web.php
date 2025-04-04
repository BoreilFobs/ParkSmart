<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get("/pricing", function () {
    return Inertia::render("Pricing");
})->name("pricing");
Route::get("/contact", function () {
    return Inertia::render("Contact");
})->name("contact");
Route::get('reserve', function () {
    return Inertia::render('Reservations');
})->name('reservations');
Route::post('/reserve/create', [ReservationController::class, 'store']);
Route::get('/reservations', [ReservationController::class, 'index']);

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::post('/edit-slot', [ReservationController::class, 'editSlot'])->name('edit-slot');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
