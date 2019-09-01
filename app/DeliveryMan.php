<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DeliveryMan extends Authenticatable
{
    use Notifiable;

    protected $table = 'delivery_men';

    protected $fillable = ['name', 'email', 'availability', 'mobile_no', 'password', 'address', 'date_of_birth', 'preffered_loc1', 'preffered_loc2', 'preffered_loc3', 'preffered_loc4'];

    protected $hidden = ['password'];

}
