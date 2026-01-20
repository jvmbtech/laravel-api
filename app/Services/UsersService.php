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

    public function create(User $user): User
    {
        try {
            $user->saveOrFail();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage()); 
        }
        return $user;
    }
}
