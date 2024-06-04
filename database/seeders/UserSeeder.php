<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Picis',
            'email' => 'admin@picis.com',
            'email_verified_at' => now(),
            'nik' => '3671011102010000',
            'group' => 'A',
            'status' => 'HOS',
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);

    }
}