<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MikrotikConfig extends Model
{
    protected $fillable = [
        'identity_name',
        'host_ip',
        'api_username',
        'api_password',
        'api_port',
    ];

    protected $hidden = [
        'api_password',
    ];
}
