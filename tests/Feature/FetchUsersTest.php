<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

function authAsUser($test)
{
    $user = User::factory()->create();

    $token = JWTAuth::fromUser($user);

    return [
        'Authorization' => "Bearer {$token}",
        'Accept'        => 'application/json',
    ];
}

test('unatuthenticated user cant get users', function () {
    getJson(
        '/api/users', [
            'Authorization' => 'Bearer foo-token'
        ],
    )->assertStatus(401);
});

test('user can get users', function () {
    getJson(
        '/api/users',
        authAsUser($this),
    )->assertStatus(200);
});
