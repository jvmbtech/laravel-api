<?php

use function Pest\Laravel\postJson;

test('unatuthenticated user cant access users create route', function () {
    postJson(
        '/api/users',
        [], [
            'Authorization' => 'Bearer foo-token'
        ],
    )->assertStatus(401);
});

test('non admin user can\'t create user', function () {
    postJson(
        '/api/users',
        userData(),
        authAsUser($this),
    )->assertStatus(403);
});

test('admin user can create user', function () {
    postJson(
        '/api/users',
        userData(),
        authAsUser($this),
    )->assertStatus(200);
});