<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('iamuser'),
            'api_key' => Str::uuid(),
            'role_id' => 1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'password' => bcrypt('password'),
            'api_key' => Str::uuid(),
            'role_id' => 1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Registered User',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
            'api_key' => Str::uuid(),
            'role_id' => 1
        ]);
   }
}
