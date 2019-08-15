<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_into_application()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('secret123!'),
        ]);

        $this->get('/login')
            ->assertOk();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123!',
        ])
            ->assertRedirect('/');
    }
}
