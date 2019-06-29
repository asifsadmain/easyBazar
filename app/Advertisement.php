<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'proposed_price', 'isSold', 'selling_date',
    ];
}
