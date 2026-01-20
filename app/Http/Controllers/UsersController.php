<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersService $userService)
    {
        $users = $userService->findAll();
        return response()->json($users);
    }

    public function store(UsersService $userService, Request $request)
    {
        try {
            $user = new User();
            $user->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'cpf' => $request->input('cpf'),
                'phone' => $request->input('phone'),
                'cellphone' => $request->input('cellphone'),
                'role' => 'user',
            ]);

            $userService->create($user);
            return response()->json($user);
        } catch (\Throwable $th) {
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
}
