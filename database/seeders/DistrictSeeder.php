<?php

namespace Database\Seeders;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $district = [
            [
               'name'=>'Mayurbhanj',
                'status'=> '1', 
            ],
            [
                'name'=>'Malkangiri',
                'status'=> '1',
            ],
        ];

        foreach ($district as $key => $value) {
            District::create($value);
        }
    }
}
