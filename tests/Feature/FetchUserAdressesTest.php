<?php

use function Pest\Laravel\getJson;

test('unatuthenticated user cant get users adresses', function () {
    getJson(
        '/api/users/1/addresses', [
            'Authorization' => 'Bearer foo-token'
        ],
    )->assertStatus(401);
});

test('user can get users adresses', function () {
    getJson(
        '/api/users/1/addresses',
        authAsUser($this),
    )->assertStatus(200);
});
