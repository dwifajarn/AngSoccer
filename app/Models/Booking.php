<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'lapangan_id',
        'date',
        'time',
        'duration',
        'total_price',
        'status',
        'payment_proof',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan(): BelongsTo
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function scopeActiveReservation($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'paid')
              ->orWhere(function ($pending) {
                  $pending->where('status', 'pending')
                          ->where(function ($sub) {
                              $sub->whereNotNull('payment_proof')
                                  ->orWhere('created_at', '>=', now()->subMinutes(30));
                          });
              });
        });
    }
}
