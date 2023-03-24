<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affectation;
use App\Services\API\AffectationService;






class AffectationController extends Controller
{
    
    
    
    protected $affectationService;

    public function __construct(AffectationService $affectationService)
    {
        $this->affectationService = $affectationService;
    }


   
   
   
    public function getAffectation()
    {

        $affectation =  $this->affectationService->getAffectationApi();

        return response()->json(['Affectations' => $affectation], 200);

    }

}
