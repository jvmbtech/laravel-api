<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(UsersService $userService)
    {
        $users = $userService->findAll();
        return response()->json($users);
    }

    public function store(UsersService $userService, StoreUserRequest $request)
    {
        try {
            $user = new User();
            $user->fill($request->validated());
            $user->role = 'user';
            
            $userService->create($user);

            return response()->json($user);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'error_message' => 'Não foi possível realizar o cadastro de usuário',
            ], 500);
        }
    }

    public function show(UsersService $userService, int $userId)
    {
        try {
            $user = $userService->findById($userId);
            
            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json([
                'error_message' => 'Não foi possível realizar o cadastro de usuário',
            ], 500);
        }
    }

    public function update(UsersService $userService, int $userId, Request $request)
    {
        try {
            $currentUser = $userService->findById($userId);
            
            $properties = [];

            if ($request->input('name')) {
                $properties['name'] = $request->input('name');
            }

            if ($request->input('email')) {
                $properties['email'] = $request->input('email');
            }
            
            if ($request->input('cpf')) {
                $properties['cpf'] = $request->input('cpf');
            }

            if ($request->input('phone')) {
                $properties['phone'] = $request->input('phone');
            }

            if ($request->input('cellphone')) {
                $properties['cellphone'] = $request->input('cellphone');
            }

            $user = $userService->update($currentUser, $properties);

            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json([
                'error_message' => 'Não foi possível editar o cadastro do usuário',
            ], 500);
        }
    }

    public function destroy(UsersService $userService, int $userId)
    {
        try {
            $user = $userService->findById($userId);
            $success = $userService->delete($user);
            return response()->json(['success'=> $success]);
        } catch (\Throwable $th) {
            return response()->json([
                'error_message' => 'Não foi possível remover o usuário',
            ], 500);
        }
    }
}
