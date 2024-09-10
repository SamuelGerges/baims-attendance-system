<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponsesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegistrationRequest;
use App\Services\IAuthService;
use App\Services\Implementation\AuthService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegistrationRequest $request)
    {

        $data = $request->validated();

        $user              = $this->authService->register($data);
        $response['user']  = $user;
        $response['token'] = $user->createToken('baims')->plainTextToken;

        return ResponsesHelper::returnData($response , 'User Register Successfully',200);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $user        = $this->authService->login($credentials);

        if(!is_object($user))
        {
            return ResponsesHelper::returnError(Response::HTTP_UNAUTHORIZED,'Unauthorized');
        }

        $response['user']  = $user;
        $response['token'] = $user->createToken('baims')->plainTextToken;

        return ResponsesHelper::returnData($response , 'User Login Successfully',200);

    }

}
