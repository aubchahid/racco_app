<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blocage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'uuid',
        'affectation_id',
        'cause',
    ];

    public function affectation()
    {
        return $this->belongsTo(Affectation::class);
    }


}
