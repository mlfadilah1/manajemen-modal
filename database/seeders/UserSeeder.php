<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ([
            $user = new User,
            $user -> name = "Admin",
            $user -> email = "admin@gmail.com",
            $user -> role = "Admin",
            $user -> password = bcrypt('1'),
            $user -> save()
            ]);
        ([
            $user = new User(),
            $user -> name = "Staff",
            $user -> email = "staff@gmail.com",
            $user -> role = 'Staff',
            $user -> password = bcrypt('2'),
            $user -> save(),
            ]);
    }
}
