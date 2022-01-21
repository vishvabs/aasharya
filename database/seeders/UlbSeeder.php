<?php

namespace Database\Seeders;
use App\Models\Ulb;
use Illuminate\Database\Seeder;

class UlbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ulb = [
            [
               'name'=>'Rajgangpur (M)',
                'status'=>'1', 
            ],
            [
                'name'=>'Banki (N)',
                'status'=>'1',
            ],
        ];

        foreach ($ulb as $key => $value) {
            Ulb::create($value);
        }
    }
}
