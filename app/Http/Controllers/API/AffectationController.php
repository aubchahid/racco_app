<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affectation;
use App\Services\API\AffectationService;

use Illuminate\Support\Str;





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
    public function createAffectation(Request $request)
    {

        $affectation =  Affectation::create([
            'uuid' => Str::uuid(),
            'client_id' =>  $request->input('client_id'),
            'technicien_id' =>  $request->input('technicien_id'),
            'status' => 'En cours',
        ]);

        return response()->json(['Affectations' => $affectation], 200);
    }

}
