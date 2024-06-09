<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
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