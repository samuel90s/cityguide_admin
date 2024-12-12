<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'price_per_night',
        'facilities',
        'latitude',
        'longitude',
        'image_url',
    ];
}
