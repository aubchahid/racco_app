<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
        
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }



    public function updateDeviseKey(Request $request)
    {

        $this->userService->updateDeviseKey($request->input('id'),$request->input('deviseKey'));
    }




    


}
