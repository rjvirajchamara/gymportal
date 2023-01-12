<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Http\Request;
use App\Http\Middleware\AuthenticateUser;

class UserCheckController extends Controller
{
    public function userCheck(Request $request)
    {
        $userData = $request->get('userData');
        $userId = $userData['user_id'];
        $userRole = $userData['role'][0];



        return $userRole;
    }

   
}
