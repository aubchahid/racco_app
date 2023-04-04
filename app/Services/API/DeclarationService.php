<?php

namespace App\Services\API;
use App\Models\Blocage;
use App\Models\Declaration;
use App\Models\Technicien;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Str;


class DeclarationService 
{
    public function getDeclarationApi()
    {
        $Declaration = Declaration::with(['client'])->get();
        return  $Declaration ;
    }

     static public function declaration(Request $request)
    {



        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 401);
        // }

        // $blocage = new Blocage;
        // // $userRating = ($request->input('user_rating') + ($user->user_rating * $user->nb_rating)) / $user->nb_rating + 1;

        // $blocage->uuid = Str::uuid();
        // $blocage->affectation_id = $request->input('affectation_id');
        // $blocage->cause =  $request->input('cause');

        $declaration = Declaration::create([
            'uuid' => Str::uuid(),
            'affectation_id' =>$request->input('affectation_id'),
            'cause' =>  $request->input('cause'),   
            'justification' =>  $request->input('justification'),
            'lat' =>  $request->input('lat'),
            'lng' =>  $request->input('lng')
        ]);


        

        return $declaration;
            // response()->json(['updated' => $user->update(), 'user' => $user,], 200);
        

        // else {
        //     return response(['created' => false, 'message' => 'user already exists'], 401);
        // }


    }
    
}
