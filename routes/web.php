<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])
    ->name('search');
// Routes that require user to be logged in
Route::middleware('auth')->group(function () {
    Route::get('/Up_coming', [HomeController::class, 'Up_coming']);
    Route::get('/event/{id}', [HomeController::class, 'show_event']);
    Route::get('/community/{id}', [HomeController::class, 'show_community']);

Route::put('/events/{event}', [AdminController::class, 'update'])->name('events.update');


Route::delete('/events/{id}', [AdminController::class, 'destroy'])->name('events.destroy');
Route::get('/add_event', [AdminController::class, 'index'])
    ->name('add_event');
Route::post('/simpan_event', [AdminController::class, 'store'])->name('events.store');
    // Add more routes here that require authentication
});

Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard');  // This refers to the Vue component located at resources/js/Pages/Admin/Dashboard.vue
});

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');  // This refers to the Vue component located at resources/js/Pages/Admin/Dashboard.vue
});

// Routes that are accessible by guest (non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/Login', function () {
        return Inertia::render('Login', ['success' => session('success')]);
    })->name('login');

    Route::get('/Register', function () {
        return Inertia::render('Register');
    })->name('register');

    Route::post('/submit_Login', [AuthController::class, 'store']);
    Route::post('/submit_register', [AuthController::class, 'register'])->name('submit_register');
});

// Routes that are accessible by anyone (both guests and authenticated users)
Route::get('/Event_info', function () {
    return Inertia::render('Event_info');
})->name('event_info');

// Logout route (can only be accessed by authenticated users)
Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';
