<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

if (config('slash-login.can_access')) {
    Route::group(['middleware' => [config('slash-login.guard')]], function () {
        Route::get('/' . config('slash-login.route') . '/{userid}', function ($userid) {
            if (!class_exists(config('slash-login.model'))) {
                /*
                 Correct the model name in config/slash-login.php
                 You can publish the config file if it doesn't exist, by running the command given below:
                 php artisan vendor:publish --tag="slash-login-config"
                 */
                throw new Exception('The configured model class (' . config('slash-login.model') . ') doesn\'t exist.');
            }

            $user = config('slash-login.model')::findOrFail($userid);

            Auth::login($user, true);

            foreach (config('slash-login.custom_session_data') as $key => $value) {
                session()->push($key, $value);
            }

            return Route::has(config('slash-login.redirect_route'))
                ? redirect(config('slash-login.redirect_route'))
                : redirect('/');
        });
    });
}
