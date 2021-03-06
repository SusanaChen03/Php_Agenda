<?php
//creacion de seeders por excelencia
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         $this->call([
             ContactSeeder::class   //trae el array de datos de contact 
            //aqui se suma los seeders que hemos creado (ej. notas)
            //NoteSeeder::class

            //php artisan db:seed RoleSeeder, lo de antes ya esta ejecutado, y o tira mas seeders.
       ]);
    }
}
