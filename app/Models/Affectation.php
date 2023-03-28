<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affectation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'uuid',
        'client_id',
        'technicien_id',
        'planification_date',
        'status',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function history()
    {
        return $this->hasMany(AffectationHistory::class);
    }

    public function technicien(){
        return $this->belongsTo(Technicien::class);
    }

    public function getStatusColor()
    {
        $data = 'success';
        switch ($this->status) {
            case 'En cours':
                $data = 'primary';
                break;
            case 'Planifié':
                $data = 'warning';
                break;
            case 'Bloqué':
                $data = 'info';
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
