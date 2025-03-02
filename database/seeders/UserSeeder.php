<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'kushan.gayantha@gmail.com',
        ], [
            'name' => 'KushanGayantha',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'type' => 'SUPER_ADMIN',
        ]);
    }
}
