<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'type',
        'name',
        'address',
        'lat',
        'lng',
        'city_id',
        'plaque_id',
        'phone_no',
        'debit',
        'sip',
        'technicien_id',
        'status',
        'created_by',
        'type',
        'created_at'
    ];

    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function plaque()
    {
        return $this->belongsTo(Plaque::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStatusColor()
    {
        $data = 'success';
        switch ($this->status) {
            case 'Saisie':
                $data = 'primary';
                break;
            case 'Affecté':
                $data = 'warning';
                break;
            case 'Declare':
                $data = 'info';
                break;
            case 'Valide':
                $data = 'success';
                break;
            default:
                $data = 'dark';
                break;
        }
        return $data;
    }

    public function technicien()
    {
        return $this->belongsTo(Technicien::class);
    }

    public function getTechnicien()
    {
        $technicien = $this->technicien()->first();
        if ($technicien) {
            return $technicien->user->getFullname();
        } else {
            return '-';
        }
    }
}
