<?php

namespace App\Observers;

use App\Models\Affectation;
use App\Models\Blocage;

class BlocageObserver
{
    /**
     * Handle the Blocage "created" event.
     *
     * @param  \App\Models\Blocage  $blocage
     * @return void
     */
    public function created(Blocage $blocage)
    {
        Affectation::find($blocage->affectation_id)->update([
            'status' => 'Bloqué',
        ]);
    }


    /**
     * Handle the Blocage "updated" event.
     *
     * @param  \App\Models\Blocage  $blocage
     * @return void
     */
    public function updated(Blocage $blocage)
    {
        //
    }

    /**
     * Handle the Blocage "deleted" event.
     *
     * @param  \App\Models\Blocage  $blocage
     * @return void
     */
    public function deleted(Blocage $blocage)
    {
        //
    }

    /**
     * Handle the Blocage "restored" event.
     *
     * @param  \App\Models\Blocage  $blocage
     * @return void
     */
    public function restored(Blocage $blocage)
    {
        //
    }

    /**
     * Handle the Blocage "force deleted" event.
     *
     * @param  \App\Models\Blocage  $blocage
     * @return void
     */
    public function forceDeleted(Blocage $blocage)
    {
        //
    }
}
