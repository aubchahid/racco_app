<?php

declare(strict_types=1);

namespace App\Services\API;
use App\Models\Client;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserService
{

    static public function updateDeviseKey($id,$deviseKey)
    {
  

          
            // $validator = Validator::make($request->all(), [
            //     'id' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     return response()->json(['error' => $validator->errors()], 401);
            // }

            $user = User::find($id);
            // $userRating = ($request->input('user_rating') + ($user->user_rating * $user->nb_rating)) / $user->nb_rating + 1;

            $user->device_key = $deviseKey;
    

            if ($user->update()) {
            
                return $user ;                
                // response()->json(['updated' => $user->update(), 'user' => $user,], 200);
            } 
            
            // else {
            //     return response(['created' => false, 'message' => 'user already exists'], 401);
            // }

      
    }


    public function getThecnincenAfectationCouteurApi($id)
    {
        $count =  Client::where("status","active")->where("thecnicien_id",$id)->count();
        return $count; 
    }




    static public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}