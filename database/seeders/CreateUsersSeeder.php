<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'user_id'=>'Admin',
                'is_admin'=>'1',
                'status'=>'1',
                'createdby_id'=>'1',
               'password'=> bcrypt('123456'),
            ],
          
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
