<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technicien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'soustraitant_id',
        'user_id',
        'status',
        'planification_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soustraitant()
    {
        return $this->belongsTo(Soustraitant::class);
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }

    public function plaques()
    {
        return $this->belongsToMany(Plaque::class, 'plaque_techniciens');
    }
}
