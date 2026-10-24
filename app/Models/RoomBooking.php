<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    protected $guarded = [];

    protected $casts = [
        'check_in' => 'date',
    ];
}
