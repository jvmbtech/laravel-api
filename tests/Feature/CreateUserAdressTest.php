<?php

use App\Models\User;

use function Pest\Laravel\postJson;

test('unatuthenticated user cant add user addresses', function () {
    postJson(
        '/api/users/1/addresses',
        [], [
            'Authorization' => 'Bearer foo-token'
        ],
    )->assertStatus(401);
});

test('non admin user can\'t add user addresses', function () {

    $user = User::factory()->create();

    $addressPayload = [
        'user_id' => $user->id,
        'street' => 'Rua X',
        'number' => '7',
        'neighborhood' => 'São José',
        'complement' => 'apto 301',
        'postal_code' => '99999999',
    ];

    postJson(
        "/api/users/$user->id/addresses",
        $addressPayload,
        authAsUser($this),
    )->assertStatus(403);
});

test('admin user can add user address', function () {

    $user = User::factory()->create();

    $addressPayload = [
        'user_id' => $user->id,
        'street' => 'Rua X',
        'number' => '7',
        'neighborhood' => 'São José',
        'complement' => 'apto 301',
        'postal_code' => '99999999',
    ];

    postJson(
        "/api/users/$user->id/addresses",
        $addressPayload,
        authAsUser($this),
    )->assertStatus(200);
});