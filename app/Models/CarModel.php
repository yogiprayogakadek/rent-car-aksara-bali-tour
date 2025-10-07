<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = [
        'car_name',
        'car_type',
        'car_brand',
        'car_description',
        'car_price',
    ];
}
