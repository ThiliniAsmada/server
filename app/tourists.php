<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class tourists extends Model
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];
}
