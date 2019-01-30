<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $userService;
    protected $authService;

    public function __construct(UserService $userService, JWTAuth $authService)
    {
        $this->userService = $userService;
        $this->authService = $userService;
    }


}
