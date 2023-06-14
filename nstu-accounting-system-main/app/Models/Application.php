<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];
    protected $casts = [
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
        'office' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
