<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daerahs = [
            ['id' => 1, 'nama' => 'Sumatra', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama' => 'Jawa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama' => 'Kalimantan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama' => 'Sulawesi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama' => 'Bali', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nama' => 'Nusa Tenggara', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nama' => 'Maluku & Papua', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($daerahs as $daerah) {
            DB::table('daerahs')->updateOrInsert(['id' => $daerah['id']], $daerah);
        }
    }
}
