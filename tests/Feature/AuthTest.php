<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_attempt(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->json('POST', '/api/auth/attempt', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_at',
            ]);
    }

    public function test_unauthorized_attempt(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('wrong_password'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->json('POST', '/api/auth/attempt', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['email'],
            ]);
    }

    public function test_success_revoke(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $token = $user->createToken('Personal Access Token', ['*'], now()->addYear());

        $response = $this->json('POST', '/api/auth/revoke', [], [
            'Authorization' => 'Bearer '.$token->plainTextToken,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    public function test_unauthorized_revoke(): void
    {
        $response = $this->json('POST', '/api/auth/revoke');

        $response->assertStatus(401);
    }
}
