<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $fillable = [
        'name',
        'address',
        'google_maps_url',
        'phone_number',
        'is_active',
        'logo_path',
    ];
}
