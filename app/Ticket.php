<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'time_at', 'type', 'event', 'place', 'seat', 'price', 'vendor_id', 'partner_id', 'partner_name', 'scope', 'address', 'verified'
    ];

    public function setTimeAtAttribute($value)
    {
        $this->attributes['time_at'] = Carbon::createFromFormat('d.m.Y H:i', $value)->toDateTimeString();
    }

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
