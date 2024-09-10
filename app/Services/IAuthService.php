<?php

namespace App\Services;

interface IAuthService
{
    public function register($data);

    public function login($credentials);

}