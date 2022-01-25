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
            [ 'name'=>'Mayurbhanj', 'status'=> '1', ],
            [ 'name'=>'Malkangiri', 'status'=> '1',],

            [ 'name'=>'Dhenkanal', 'status'=> '1', ],
            [ 'name'=>'Keonjhar', 'status'=> '1',],
            [ 'name'=>'Ganjam', 'status'=> '1', ],
            [ 'name'=>'Sundargarh', 'status'=> '1',],
            [ 'name'=>'Bhadrak', 'status'=> '1', ],
            [ 'name'=>'Jharsuguda', 'status'=> '1',],
            [ 'name'=>'Jajpur', 'status'=> '1', ],
            [ 'name'=>'Nabarangpur', 'status'=> '1',],
            [ 'name'=>'Angul', 'status'=> '1', ],
            [ 'name'=>'Sambalpur', 'status'=> '1',],
            [ 'name'=>'Rayagada', 'status'=> '1', ],
            [ 'name'=>'Balangir', 'status'=> '1',],
            [ 'name'=>'Jagatsinghpur', 'status'=> '1', ],
            [ 'name'=>'Subarnapur', 'status'=> '1',],
            [ 'name'=>'Nayagarh', 'status'=> '1', ],
            [ 'name'=>'Kendrapara', 'status'=> '1',],

            [ 'name'=>'Bargarh', 'status'=> '1',],
            [ 'name'=>'Puri', 'status'=> '1', ],
            [ 'name'=>'Kandhamal', 'status'=> '1',],
            [ 'name'=>'Deogarh', 'status'=> '1', ],
            [ 'name'=>'Khordha', 'status'=> '1',],
            [ 'name'=>'Gajapati', 'status'=> '1', ],
            [ 'name'=>'Balasore', 'status'=> '1',],
            [ 'name'=>'Nuapada', 'status'=> '1', ],
            [ 'name'=>'Cuttack', 'status'=> '1',],
            [ 'name'=>'Koraput', 'status'=> '1', ],
            [ 'name'=>'Kalahandi', 'status'=> '1',],
            [ 'name'=>'Boudh', 'status'=> '1',],
        ];

        foreach ($district as $key => $value) {
            District::create($value);
        }
    }
}
