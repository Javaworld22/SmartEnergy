<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_readings extends Model
{
    protected $table = 'current_readings';

    protected $fillable = [
        'meter_no', 'address', 'voltage', 'current', 'real_power', 'energy', 'power_factor', 'time', 'user_id','reactive_factor', 'reactive_power', 'apparent_power', 'angle', 'temper', 'is_active',
    ];
}
