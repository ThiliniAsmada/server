<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class timelines extends Model
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'place', 'date','image',
    ];
}
