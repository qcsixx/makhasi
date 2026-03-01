<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DaerahSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin MaKhasi',
            'email' => 'admin@makhasi.com',
            'password' => bcrypt('password'),
            'usertype' => '1',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@makhasi.com',
            'password' => bcrypt('password'),
            'usertype' => '0',
        ]);
    }
}
