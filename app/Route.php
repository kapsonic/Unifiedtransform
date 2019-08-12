<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //
    protected $fillable = [
        'name', 'source', 'destination', 'startTime', 'endTime', 'stops'
    ];
    protected $casts = [
        'stops' => 'array'
    ];

}
