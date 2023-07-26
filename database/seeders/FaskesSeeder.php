<?php

namespace Database\Seeders;

use App\Models\Faskes;
use App\Models\Kota;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaskesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');
        $kota = Kota::get();


        foreach($kota as $item){
            print("Seeder Faskes Kota ".$item->nm_kota . " \n");
            Faskes::create([
                'nm_faskes' => "Puskesmas $item->nm_kota",
                'telepon' => $faker->PhoneNumber(),
                'alamat' => $faker->address(),
                'tipe' => 'puskesmas',
                'kota_id' => $item->id,
            ]);
            Faskes::create([
                'nm_faskes' => "Rumah Sakit $item->nm_kota",
                'telepon' => $faker->PhoneNumber(),
                'alamat' => $faker->address(),
                'tipe' => 'rumah_sakit',
                'kota_id' => $item->id,
            ]);
            Faskes::create([
                'nm_faskes' => "Klinik $item->nm_kota",
                'telepon' => $faker->PhoneNumber(),
                'alamat' => $faker->address(),
                'tipe' => 'klinik',
                'kota_id' => $item->id,
            ]);
        }
    }
}
