<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\API\AuthService;


class AuthController extends Controller
{
   


    protected $loginService;

    public function __construct(AuthService $loginService)
    {
        $this->loginService = $loginService;
    }


    public function loginApi(Request $request)
    {


        $user =  $this->loginService->loginApi($request->input('email'),$request->input('password'));

    
        return response()->json(['User' => $user], 200);
    }


    
    public function registerApi(Request $request)
    {


        $user =  $this->loginService->loginApi($request->input('email'),$request->input('password'));

    
        return response()->json(['User' => $user], 200);
    }
}
