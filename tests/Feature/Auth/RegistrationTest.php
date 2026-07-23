<?php

namespace Tests\Feature\Auth;

test('registration is disabled and redirects guest users to login', function () {
    $response = $this->get('/register');

    $response->assertRedirect('/login');
});
