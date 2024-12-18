<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
if (config('app.env') != 'production') {
    Route::group(['middleware' => [config('slash-login.guard')]], function () {
    Route::get('/'.config('slash-login.route').'/{userid}', function ($userid) {
        if (!class_exists(config('slash-login.model'))){
            /*
             Correct the model name in config/slash-login.php
             You can publish the config file if it doesn't exist, by running the command given below:
             php artisan vendor:publish --tag="slash-login"
             */
            throw new Exception('The configured model class ('.config('slash-login.model').') doesn\'t exist.');

        }
        $user = config('slash-login.model')::findOrFail($userid);
        $guard = config('slash-login.guard');
        Auth::login($user, true);
        foreach (config('slash-login.custom_session_data') as $key => $value) {
            session()->push($key,$value);
        }
        if (!Route::has(config('slash-login.redirect_route'))){
            /*
             * You should configure the redirect_route in the config/slash-login.php file.
             * The redirect_route should be a valid route name.
             *
             */
            throw new Exception('The configured route does not exist.');
        }
        return redirect(config('slash-login.redirect_route'));
     });
    });
}