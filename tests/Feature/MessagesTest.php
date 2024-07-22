<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class MessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_feature(): void
    {
        $sender = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'verification_token' => Str::random(64),
        ]);

        $response = $this->actingAs($sender)->json('POST', '/api/users/'.$user->id.'/send', [
            'body' => 'blah',
        ]);

        $response->assertStatus(200);

        $response = $this->actingAs($sender)->json('GET', '/api/users/'.$user->id.'/receive');

        $response->assertStatus(200);
    }
}
