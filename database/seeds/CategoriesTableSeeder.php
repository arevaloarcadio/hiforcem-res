<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'      =>  'Pretensada',
            'slug'     =>  'vigueta-pretensada',
            'parent_id' => '0'
        ]);
        Category::create([
            'name'      =>  'Armada',
            'slug'     =>  'vigueta-armada',
            'parent_id' => '0'
        ]);
        Category::create([
            'name'      =>  'Pérgolas',
            'slug'     =>  'pergolas',
            'parent_id' => '0'
        ]);
        Category::create([
            'name'      =>  'Hincos',
            'slug'     =>  'hincos',
            'parent_id' => '0'
        ]);
        Category::create([
            'name'      =>  'Placas',
            'slug'     =>  'placas',
            'parent_id' => '0'
        ]);
        Category::create([
            'name'      =>  'P-12',
            'slug'     =>  'P-12',
            'parent_id' => '1'
        ]);
        Category::create([
            'name'      =>  'T-17',
            'slug'     =>  'T-17',
            'parent_id' => '1'
        ]);
        Category::create([
            'name'      =>  'Único',
            'slug'     =>  'unico',
            'parent_id' => '2'
        ]);
        Category::create([
            'name'      =>  '10x15',
            'slug'     =>  '10x15',
            'parent_id' => '3'
        ]);
        Category::create([
            'name'      =>  '12x20',
            'slug'     =>  '12x20',
            'parent_id' => '3'
        ]);
        Category::create([
            'name'      =>  '12x25',
            'slug'     =>  '12x25',
            'parent_id' => '3'
        ]);
        Category::create([
            'name'      =>  '14x28',
            'slug'     =>  '14x28',
            'parent_id' => '3'
        ]);
    }
}