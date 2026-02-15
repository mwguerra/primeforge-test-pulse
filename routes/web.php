<?php

use App\Models\Heartbeat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $heartbeats = Heartbeat::latest()->take(50)->get();
    $schedulerCount = Heartbeat::where('source', 'scheduler')->count();
    $queueCount = Heartbeat::where('source', 'queue')->count();

    return view('dashboard', compact('heartbeats', 'schedulerCount', 'queueCount'));
});
