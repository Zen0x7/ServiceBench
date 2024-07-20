<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_index(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->actingAs($user)->json('GET', '/api/users');

        $response->assertStatus(200);
    }

    public function test_users_show(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->actingAs($user)->json('GET', "/api/users/{$user->id}");

        $response->assertStatus(200);
    }
}
