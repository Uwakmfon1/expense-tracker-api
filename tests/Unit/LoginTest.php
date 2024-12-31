<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_and_receive_sanctum_token()
    {
        $user = User::factory()->create([
            'email' => 'johndoe1@ex.com',
            'password' => bcrypt('johndoe1'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'johndoe1@ex.com',
            'password' => 'johndoe1',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'message',
        ]);

        $this->assertDatabaseCount('personal_access_tokens', 1);
        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class,
        ]);
    }
}
