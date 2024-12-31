<?php

return [
    'route' => 'login', // Configure the route path for slash login (default: login)
    'model' => \App\Models\User::class, // Configure the model for slash login (default: App\Models\User)
    'redirect_route' => '/', // Configure the redirect route name after login. Make sure the route with this name exists. (default: /)
    'guard' => 'web',
    'can_access' => env('APP_ENV') !== 'production',
    'custom_session_data' => [
        '2fa_verified' => 1,
        // add as many as you want
    ],
];
