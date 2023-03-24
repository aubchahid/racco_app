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
        'created_at',
        'updated_at',
    ];

    public function technicien(){
        return $this->belongsTo(Technicien::class);
    }

    public function getStatusColor(){
        $data = 'success';
        switch ($this->status) {            
            case 'Blocage':
                $data = 'danger';
                break;
            case 'En cours':
                $data = 'warning';
                break;
            case 'Planifie':
                $data = 'info';
                break;
            case 'Valide' :
                $data = 'success';
                break;
            default:
                $data = 'dark';
                break;
        }
        return $data;
    }
}
