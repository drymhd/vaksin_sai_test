<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        print("< == Seeder Provinsi  ==>");
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, 'https://ibnux.github.io/data-indonesia/provinsi.json');
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        $data = json_decode($result, true);

        DB::statement("SET foreign_key_checks=0");
        Provinsi::truncate();
        DB::statement("SET foreign_key_checks=1");

        foreach ($data as $item) {
            print("Seeder Provisnsi ".$item['nama'] . " \n");
            $provinsi = new Provinsi();

            $provinsi->uuid = Str::uuid();
            $provinsi->id = $item['id'];
            $provinsi->nm_provinsi = $item['nama'];
            $provinsi->save();
        }
        print("Selesai \n");
    }
}
