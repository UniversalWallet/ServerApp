<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'type', 'event', 'place', 'price', 'vendor_id', 'partner_id', 'partner_name', 'scope', 'address', 'verified'
    ];

}
