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

    public function declarations()
    {
        return $this->hasManyThrough(Declaration::class, Affectation::class);
    }

    public function blocages()
    {
        return $this->hasManyThrough(Blocage::class, Affectation::class);
    }

    public function affectationsHistorique()
    {
        return $this->hasManyThrough(AffectationHistory::class,Affectation::class);
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

    public function technicien()
    {
        return $this->belongsTo(Technicien::class);
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
            case 'Validée':
                $data = 'success';
                break;
            default:
                $data = 'dark';
                break;
        }
        return $data;
    }

    public function returnPhoneNumber()
    {
        $input = $this->phone_no;
        return substr($input, 0, 2) . ' ' . substr($input, 2, 2) . ' ' . substr($input, 4, 2) . ' ' . substr($input, 6, 2) . ' ' . substr($input, 8, 2);
    }
}
