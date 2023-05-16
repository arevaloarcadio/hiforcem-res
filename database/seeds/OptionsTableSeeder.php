<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            'category_id'      =>  8,
            'question'     =>  'Punta',
            "values" => '[{"value": "Sí","image": "foto.jpg"},{"value": "No","image": "foto.jpg"}]',
            'type' => 'secundary'
        ]);
        Option::create([
            'category_id'      =>  8,
            'question'     =>  'Armadura',
            "values" => '[{"value": "17","image": "foto.jpg"},{"value": "20","image": "foto.jpg"},{"value": "23","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);

        Option::create([
            'category_id'      =>  4,
            'question'     =>  'Agujeros',
            "values" => '[{"value": "3","image": "foto.jpg"},{"value": "4","image": "foto.jpg"},{"value": "5","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);

        Option::create([
            'category_id'      =>  9,
            'question'     =>  'Función',
            "values" => '[{"value": "Carga","image": "foto.jpg"},{"value": "Decorativa","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  10,
            'question'     =>  'Función',
            "values" => '[{"value": "Carga","image": "foto.jpg"},{"value": "Decorativa","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  11,
            'question'     =>  'Función',
            "values" => '[{"value": "Carga","image": "foto.jpg"},{"value": "Decorativa","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  12,
            'question'     =>  'Función',
            "values" => '[{"value": "Carga","image": "foto.jpg"},{"value": "Decorativa","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);

        Option::create([
            'category_id'      =>  9,
            'question'     =>  'Cabezas',
            "values" => '[{"value": "0","image": "foto.jpg"},{"value": "1","image": "foto.jpg"},{"value": "2","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  10,
            'question'     =>  'Cabezas',
            "values" => '[{"value": "0","image": "foto.jpg"},{"value": "1","image": "foto.jpg"},{"value": "2","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  11,
            'question'     =>  'Cabezas',
            "values" => '[{"value": "0","image": "foto.jpg"},{"value": "1","image": "foto.jpg"},{"value": "2","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
        Option::create([
            'category_id'      =>  12,
            'question'     =>  'Cabezas',
            "values" => '[{"value": "0","image": "foto.jpg"},{"value": "1","image": "foto.jpg"},{"value": "2","image": "foto.jpg"}]',
            'type' => 'primary'
        ]);
    }
}