<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthenticateUser;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function userCheck(AuthenticateUser $authenticateUser)
    {
        $user = unserialize($authenticateUser->getUserData());
        dd($user);
    }
}
