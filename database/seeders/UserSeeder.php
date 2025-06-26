<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'admin' => true,
                    'password' => Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Jane Doe',
                    'email' => 'jane.doe@example.com',
                    'admin' => false,
                    'password' => Hash::make('user1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ]
            ]
        );

        // Add 10 dummy users inside a loop
        for ($i = 0; $i <= 10; $i++) {
            // Every 6th user, $active is false (0) else true (1)
            $active = ($i + 1) % 6 !== 0;
            DB::table('users')->insert(
                [
                    'name' => "ITF User $i",
                    'email' => "itf_user_$i@mailinator.com",
                    'password' => Hash::make("itfuser$i"),
                    'active' => $active,
                    'created_at' => now(),
                    'email_verified_at' => now()
                ]
            );
        }
    }
}
