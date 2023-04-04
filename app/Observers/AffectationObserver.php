<?php

namespace App\Observers;

use App\Models\Affectation;
use App\Models\AffectationHistory;
use App\Models\Client;

class AffectationObserver
{

    public function created(Affectation $affectation)
    {


        
        AffectationHistory::create([
            'affectation_id' => $affectation->id,
            'technicien_id' => $affectation->technicien_id,
            'status' => $affectation->status
        ]);

        Client::where('id',$affectation->client_id)->update([           
            'status' => 'Affecté',
            'technicien_id' => $affectation->technicien_id
            
        ]);
    }


    public function updated(Affectation $affectation)
    {
        AffectationHistory::create([
            'affectation_id' => $affectation->id,
            'technicien_id' => $affectation->technicien_id,
            'status' => $affectation->status,
        ]);
    }

    public function deleted(Affectation $affectation)
    {
        //
    }


    public function restored(Affectation $affectation)
    {
        //
    }


    public function forceDeleted(Affectation $affectation)
    {
        //
    }
}
