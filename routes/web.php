<?php

use App\Http\Controllers\Backend\TaskAssignController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'as' => 'backend.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');

    Route::get('task-assign/{task}', [TaskAssignController::class, 'create'])->name('task_assign.create');
    Route::post('task-assign/{task}', [TaskAssignController::class, 'store'])->name('task_assign.store');
});

require __DIR__.'/auth.php';
