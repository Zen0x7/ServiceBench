<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $user = User::query()->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'password',
            'verification_token' => Str::random(64),
        ]);

        $this->assertEquals('john@doe.com', $user->email);
    }
}
