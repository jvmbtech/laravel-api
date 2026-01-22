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

    public function create(UserAddress $userAddress): UserAddress
    {
        try {
            $userAddress->id = DB::table('user_addresses')->insertGetId([
                'user_id' => $userAddress->user_id,
                'street' => $userAddress->street,
                'number' => $userAddress->number,
                'neighborhood' => $userAddress->neighborhood,
                'complement' => $userAddress->complement,
                'postal_code' => $userAddress->postal_code, 
            ]);

            if (!$userAddress || $userAddress->id == 0) {
                throw new \Exception("Erro na criação de endereço do usuário #$userAddress->user_id");
            }

        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        return $userAddress;
    }
}
