<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = Provinsi::get();
        foreach ($datas as $data) {

            print("< == Seeder Provinsi $data->nm_provinsi ==>");
            //  Initiate curl
            $ch = curl_init();
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL, 'https://ibnux.github.io/data-indonesia/kabupaten/'.$data->id.'.json');
            // Execute
            $result = curl_exec($ch);
            // Closing
            curl_close($ch);

            // Will dump a beauty json :3

            $kota = json_decode($result, true);
            foreach ($kota as $item) {
                print("Seeder Kota " . $item['nama'] . " \n");
                $kota = new Kota();

                $kota->uuid = Str::uuid();
                $kota->provinsi_id = $data->id;
                $kota->nm_kota = $item['nama'];
                $kota->save();
            }
            print("Selesai \n");
        }
    }
}
