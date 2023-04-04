<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soustraitant extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
    ];

    public function techniciens(){
        return $this->hasMany(Technicien::class);
    }

    public function clients(){
        return $this->hasManyThrough(Client::class, Technicien::class);
    }

    public function affectations()
    {
        return $this->hasManyThrough(Affectation::class, Technicien::class)->whereMonth('affectations.created_at', now()->month)->whereYear('affectations.created_at', now()->year);
    }

}
