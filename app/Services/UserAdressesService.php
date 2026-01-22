<?php

namespace App\Services;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UserAdressesService
{
    public function findAll(int $userId): array
    {
        $adresses = DB::table('user_addresses')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();
        
        return $adresses;
    }
}
