<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\TaskDeadlineReminder;
use Illuminate\Support\Facades\Mail;
use App\Models\Task;

Route::get('/test-email', function () {
    $task = App\Models\Task::first(); // or use find(1)
    Mail::to('test@example.com')->send(new TaskDeadlineReminder($task));
    return 'Test email sent (check storage/logs/laravel.log)';
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task routes
    Route::resource('tasks', TaskController::class)->except(['index']);

    // Status update route
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.update.status');
});

require __DIR__.'/auth.php';