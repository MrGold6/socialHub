<?php

namespace App\ServiceLera;

use App\Models\User;

class UserService
{
    public static function getAll()
    {
        return User::all();
    }
}
