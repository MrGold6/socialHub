<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Users {
    public static function getUserById($id) {
        return User::find($id);
    }
}
