<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class tours extends Model
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'tour_type', 'place', 'date', 'No_of_days','tourist_id','guide_id',"guide_rating","tourist_rating"
    ];
}
