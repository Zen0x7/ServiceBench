<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PulseTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => env('APP_ADMIN_EMAIL', 'iantorres@outlook.com'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->actingAs($user)->get('/pulse');

        $response->assertStatus(200);
    }
}
