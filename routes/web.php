<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes (for authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Task management routes (for authenticated users only)
Route::middleware('auth')->group(function () {
    // Task listing
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Task creation
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Delete selected tasks
    Route::post('/tasks/deleteSelected', [TaskController::class, 'deleteSelected'])->name('tasks.deleteSelected');

    // Update selected task statuses
    Route::post('/tasks/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');

    // Today's tasks
    Route::get('/tasks/today', [TaskController::class, 'todayTasks'])->name('tasks.today');
    
    // Completed tasks
    Route::get('/tasks/completed', [TaskController::class, 'completedTasks'])->name('tasks.completed');
});


// Include the authentication routes
require __DIR__ . '/auth.php';
