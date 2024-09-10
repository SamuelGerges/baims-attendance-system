<?php

namespace App\Repositories;

interface IUser
{
    public function getUsers();

    public function register($data);

}