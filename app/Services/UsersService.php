<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersService
{
    public function findAll()
    {
        return User::all();
    }
}
