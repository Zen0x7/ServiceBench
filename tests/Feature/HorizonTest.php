<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class HorizonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create([
            'email' => env('APP_ADMIN_EMAIL', 'iantorres@outlook.com'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->actingAs($user)->get('/horizon');

        $response->assertStatus(200);
    }
}
