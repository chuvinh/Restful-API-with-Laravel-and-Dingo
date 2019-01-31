<?php

namespace App\Http\Controllers\Auth;

use App\Http\Transformers\UserTransformer;
use App\Services\UserService;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $userService;
    protected $authService;

    public function __construct(UserService $userService, JWTAuth $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    /**
     * Get login token
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $token = $this->authService->attempt(
            $request->only(['email', 'password'])
        );

        // if we didn't get our token throw error
        if(!$token)
        {
            throw new UnauthorizedHttpException('jwt');
        }

        // if we get token return it
        return $this->success([
            'token' => $token
        ]);
    }

    public function refreshToken()
    {
        return $this->authService->parseToken()->refresh();
    }


    public function getUser(Request $request)
    {
        return $this->response->item($request->user(), new UserTransformer());
    }

    public function register(Request $request)
    {
        $user = $this->userService->create($request->all());
        return $this->response->item($request->user(), new UserTransformer());
    }
}
