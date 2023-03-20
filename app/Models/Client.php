<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',        
        'name',
        'address',
        'city_id',
        'plaque_id',
        'phone_no',
        'debit',        
        'sip',
        'status',
        'type',
        'created_at'
    ];

    public function affectations(){
        return $this->hasMany(Affectation::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function plaque(){
        return $this->belongsTo(Plaque::class);
    }

    public function getStatusColor($status){
        $data = 'text-success';
        switch ($status) {
            case 'Saisie':
                $data = 'text-success';
                break;
            case 'Blocage':
                $data = 'text-danger';
                break;
            case 'En cours':
                $data = 'text-warning';
                break;
            case 'Terminé':
                $data = 'text-info';
                break;
            default:
                $data = 'text-dark';
                break;
        }
        return $data;
    }
}
