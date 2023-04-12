<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'id',
        'uuid',
        'name',
        'code',
        'status',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function plaques()
    {
        return $this->hasMany(Plaque::class);
    }
}
