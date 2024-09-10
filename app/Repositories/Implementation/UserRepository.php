<?php

namespace App\Repositories\Implementation;

use App\Models\User;
use App\Repositories\IUser;

class UserRepository implements IUser
{
    public function getUsers()
    {
        return User::query()->select('id', 'name', 'email')->get(); // Or however you determine the user
    }


    public function register($data)
    {
        $user = User::query()->create($data);
        return $user;
    }


}