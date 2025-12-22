<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\User;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date'=>'datetime',
        'end_date'=>'datetime',
        'active'=>'boolean',
    ];

    public function plan() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
