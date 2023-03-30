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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function techniciens()
    {
        return $this->hasMany(PlaqueTechnicien::class);
    }
}
