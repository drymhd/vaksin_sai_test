<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kota;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(ProvinsiSeeder::class);
        $this->call(KotaSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin',
        //     'level' => 'admin',
        //     'password' => bcrypt('admin'),
        // ]);
    }
}
