<?php

namespace Tests\Unit;

use FahadYousafMahar\SlashLogin\SlashLoginServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Tests\Models\UserModel;
use Tests\TestCase;

class SlashLoginTest extends TestCase
{
    protected SlashLoginServiceProvider $provider;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('app.key', 'base64:Uhu8qLh31UGEZMgv13DOM1iEi6YY3/UVluwSftzncYs=');

        $this->provider = new SlashLoginServiceProvider($this->app);
        $this->provider->boot();

        Route::get('/', static fn() => 'Home');

        // Base configuration
        Config::set('slash-login.model', UserModel::class);
        Config::set('slash-login.route', 'slash-login');
        Config::set('slash-login.guard', 'web');
    }

    public function test_slash_login_is_disabled_in_production()
    {
        Config::set('app.env', 'production');

        $this->get('/login/1')->assertStatus(404);
    }

    public function test_slash_login_works_in_non_production_environments()
    {
        Config::set('app.env', 'local');

        UserModel::create([
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testing',
        ]);

        $this->get('/login/1')->assertRedirect('/');
    }

    public function test_invalid_user_id_returns_404()
    {
        $this->get('/login/999')->assertStatus(404);
    }

    public function test_custom_session_data_is_set_after_login()
    {
        UserModel::create([
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testing',
        ]);

        Config::set('slash-login.custom_session_data', ['test_key' => 'test_value']);

        $this->get('/login/1');

        $this->assertEquals('test_value', session('test_key')[0]);
    }

    public function test_custom_redirect_route_works()
    {
        UserModel::create([
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testing',
        ]);

        Route::get('/dashboard', fn() => 'Dashboard')->name('dashboard');
        Config::set('slash-login.redirect_route', 'dashboard');

        $this->get('/login/1')->assertRedirect('/dashboard');
    }

    public function test_user_authentication_persists_after_login()
    {
        $user = UserModel::create([
            'id' => 1,
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testing',
        ]);

        $this->get('/login/1');

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }
}
