<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->findAll()->paginate(3);
        return response()->json($users);
    }
}
