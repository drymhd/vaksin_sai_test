<?php

namespace Database\Seeders;

use App\Models\Vaksin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaksinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            'Sinovac', 'AstraZeneca', 'Sinopharm', 'Moderna', 'Pfizer', 'Novavax'
        ];

        foreach($data as $item){
            Vaksin::create([
                'nm_vaksin' => $item,
            ]);
        }


    }
}
