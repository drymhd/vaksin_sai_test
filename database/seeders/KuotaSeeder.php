<?php

namespace Database\Seeders;

use App\Models\Faskes;
use App\Models\FaskesVaksin;
use App\Models\Vaksin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faskes = Faskes::get();
        $vaksin = Vaksin::get();
        foreach($faskes as $item){
            print("Seeder Faskes ".$item->nm_fakses . " \n");
            foreach($vaksin as $vak){
                FaskesVaksin::create([
                    'faskes_id' => $item->id,
                    'vaksin_id' => $vak->id,
                    'kuota' => rand(1, 300)
                ]);
            }
            }
    }
}
