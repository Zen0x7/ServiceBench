<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Ian Torres',
            'email' => 'iantorres@outlook.com',
            'password' => bcrypt('S3CR3T_pa$$w0rd'),
            'email_verified_at' => now(),
            'verification_token' => Str::random(64),
        ]);
    }
}
