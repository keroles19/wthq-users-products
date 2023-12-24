<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Admin User
        User::factory()->create([
            'name' => 'admin',
            'user_name' => 'admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);

        // Normal, silver, gold, users

        $users = [
            'normal' => 'normal',
            'silver' => 'silver',
            'gold' => 'gold',
        ];

        foreach ($users as $key => $value) {
            User::factory()->create([
                'name' => $key,
                'user_name' => $key,
                'password' => bcrypt($key),
                'is_admin' => false,
                'type' => $key
            ]);
        }

    }
}
