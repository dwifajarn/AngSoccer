<?php

use App\Models\Booking;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('bookings:cleanup-expired', function () {
    $count = Booking::where('status', 'pending')
        ->whereNull('payment_proof')
        ->where('created_at', '<', now()->subMinutes(30))
        ->update(['status' => 'cancelled']);

    $this->info("Cancelled {$count} expired pending bookings.");
})->purpose('Auto-cancel unpaid pending bookings older than 30 minutes');

Schedule::command('bookings:cleanup-expired')->everyTenMinutes();
