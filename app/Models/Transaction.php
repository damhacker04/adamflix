<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Plan;
use App\Models\Membership;


class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'transaction_number',
        'total_amount',
        'payment_status',
        'midtrans_snap_token',
        'midtrans_booking_code',
        'midtrans_transaction_id',
    ];

    public function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function membership() : \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Membership::class);
    }
}
