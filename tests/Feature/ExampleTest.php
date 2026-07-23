<?php

it('redirects unauthenticated users to login page', function () {
    $response = $this->get('/');

    $response->assertRedirect('login');
});
