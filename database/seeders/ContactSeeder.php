<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        DB::table('contacts')->insert(
            [
            'name'=>'Antonio',
            'surname'=>'Perez',
            'email'=>'antonio@antonio.com',
            'phone_number'=>'666888999',
            'user_id'=> 1
            ]
            );
            
        DB::table('contacts')->insert(
            [
            'name'=>'Ana',
            'surname'=>'García',
            'email'=>'ana@ana.com',
            'phone_number'=>'22255566',
            'user_id'=> 2
            ]
            );
    }
};
