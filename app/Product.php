<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'brand', 'category_id', 'condition', 'buying_year', 'specification', 'color', 'weight', 'size', 'guarantee', 'warranty', 'display_image', 'img1', 'img2', 'img3', 'img4',
    ];
}
