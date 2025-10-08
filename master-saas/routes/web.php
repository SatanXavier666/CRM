<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/demo', function () {
    return Inertia::render('Login');
})->name('demo');

Route::get('/health', function () {
    $status = 'operational';
    $checks = [];

    // Database check
    try {
        \DB::connection()->getPdo();
        $checks['database'] = ['status' => 'operational', 'message' => 'Connected'];
    } catch (\Exception $e) {
        $checks['database'] = ['status' => 'degraded', 'message' => 'Connection issue'];
        $status = 'degraded';
    }

    // Cache check
    try {
        \Cache::put('health_check', true, 10);
        $checks['cache'] = ['status' => 'operational', 'message' => 'Working'];
    } catch (\Exception $e) {
        $checks['cache'] = ['status' => 'degraded', 'message' => 'Cache issue'];
    }

    // Storage check
    $checks['storage'] = [
        'status' => is_writable(storage_path()) ? 'operational' : 'degraded',
        'message' => is_writable(storage_path()) ? 'Writable' : 'Read-only'
    ];

    return response()->json([
        'status' => $status,
        'timestamp' => now()->toIso8601String(),
        'checks' => $checks,
        'version' => config('app.version', '1.0.0')
    ]);
})->name('health');
