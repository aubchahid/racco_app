<?php

namespace App\Services\API;

use App\Models\Blocage;
use App\Models\Declaration;
use App\Models\Technicien;
use App\Models\Validation;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Str;


class ValidationService
{


    static public function validation(Request $request)
    {





        $validation = Validation::create([
            'uuid' => Str::uuid(),
            'affectation_id' => $request->input('affectation_id'),
            'cause' =>  $request->input('cause'),
            'justification' =>  $request->input('justification'),
            'lat' =>  $request->input('lat'),
            'lng' =>  $request->input('lng')
        ]);




        return $validation;
        // response()->json(['updated' => $user->update(), 'user' => $user,], 200);


        // else {
        //     return response(['created' => false, 'message' => 'user already exists'], 401);
        // }


    }
}
