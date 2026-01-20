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

    public function findById(int $userId): User
    {
        try {
            $user = User::findOrFail($userId);

        } catch (\Throwable $th) {
            throw $th;
        }

        return $user;
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

    public function update(User $user, array $properties): User
    {
        try {
            $user->updateOrFail($properties);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        return $user;
    }
}
