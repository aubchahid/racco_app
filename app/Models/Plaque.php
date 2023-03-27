<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaque extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'code_plaque',
        'status',
        'created_at',
        'updated_at',
    ];
}
