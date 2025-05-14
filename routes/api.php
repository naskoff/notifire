<?php

declare(strict_types=1);

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/notifications', NotificationController::class)->name('notifications');
