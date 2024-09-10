<?php

namespace App\Services\Implementation;

use App\Repositories\IAuth;
use App\Repositories\IUser;
use App\Services\IAuthService;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
    protected $userRepository;

    /**
     * @param $authRepository
     */
    public function __construct(IUser $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data)
    {
        return $this->userRepository->register($data);
    }


    public function login($credentials)
    {

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']]))
        {
            return Auth::user();
        }

        return false;
    }


}