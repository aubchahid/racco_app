<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'affectation_id',
        'technicien_id',
        'status',
        'cause',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function technicien(){
        return $this->belongsTo(Technicien::class);
    }

    public function affectation(){
        return $this->belongsTo(Affectation::class);
    }

    public function getStatusColor(){
        $data = 'success';
        switch ($this->status) {
            case 'En cours':
                $data = 'primary';
                break;
            case 'Planifié':
                $data = 'warning';
                break;
            case 'Bloqué':
                $data = 'danger';
                break;
            case 'Terminé':
                $data = 'success';
                break;
            default:
                $data = 'dark';
                break;
        }
        return $data;
    }
}
