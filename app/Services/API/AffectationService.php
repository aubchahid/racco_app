<?php

namespace App\Services\API;
use App\Models\Affectation;
use App\Models\Technicien;


class AffectationService 
{
    public function getAffectationApi()
    {
        $affectation = Affectation::with(['client'])->get();
        return  $affectation ;
    }
    public function getThecnincenAfectationCouteurApi()
    {
        $count = Technicien::where("id",1)->count();
        return  $count;
    }
    
}
