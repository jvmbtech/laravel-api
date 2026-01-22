<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Services\UserAdressesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserAddressesController extends Controller
{
    public function index(UserAdressesService $userAddressesService, int $userId)
    {
        $userAddresses = [];
        try {
            $userAddresses = $userAddressesService->findAll($userId);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'success' => false,
                'error_message' => 'Não foipossível carregar os endereços do usuário',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $userAddresses,
        ]);
    }

    public function store(UserAdressesService $userAddressesService, Request $request)
    {
        try {
            $userAddress = new UserAddress();
            $userAddress->fill($request->all());
            
            $userAddressesService->create($userAddress);

            return response()->json($userAddress);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'error_message' => 'Não foi possível realizar o cadastro de usuário',
            ], 500);
        }
    }
}
