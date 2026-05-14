<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    protected $fillable = [
        'mac_address',
        'ip_address',
        'card_number',
        'status',
        'timestamp',
    ];

    public $timestamps = false;
}
