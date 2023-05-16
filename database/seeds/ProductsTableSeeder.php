<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
            'title'      =>  '12/1',
            'slug'     =>  '12-1',
            'description' => 'Descripción de las propiedades',
            'weight' => '12',
            'cost' => '3.18',
            'price' => '3.18',
            'max_size' => '3.8',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  'D12/1',
            'slug'     =>  'D12-1',
            'description' => 'Descripción de las propiedades',
            'weight' => '12',
            'cost' => '3.18',
            'price' => '3.18',
            'max_size' => '1.8',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  '12/2',
            'slug'     =>  '12-2',
            'description' => 'Descripción de las propiedades',
            'weight' => '14',
            'cost' => '3.5',
            'price' => '3.61',
            'max_size' => '4.5',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  '12/3',
            'slug'     =>  '12-3',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '3.86',
            'max_size' => '5.1',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  '12/4',
            'slug'     =>  '12-4',
            'description' => 'Descripción de las propiedades',
            'weight' => '14',
            'cost' => '3.5',
            'price' => '4.41',
            'max_size' => '5.6',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  '12/5',
            'slug'     =>  '12-5',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.8',
            'max_size' => '6.3',
            'category_id' => '6',
            ]
        ,
            [
            'title'      =>  '17/1',
            'slug'     =>  '17-1',
            'description' => 'Descripción de las propiedades',
            'weight' => '12',
            'cost' => '3.18',
            'price' => '3.50',
            'max_size' => '3.6',
            'category_id' => '7',
            ]
        ,
            [
            'title'      =>  '17/2',
            'slug'     =>  '17-2',
            'description' => 'Descripción de las propiedades',
            'weight' => '14',
            'cost' => '3.5',
            'price' => '4',
            'max_size' => '4.4',
            'category_id' => '7',
            ]
        ,
            [
            'title'      =>  '17/3',
            'slug'     =>  '17-3',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.14',
            'max_size' => '5',
            'category_id' => '7',
            ]
        ,
            [
            'title'      =>  '17/4',
            'slug'     =>  '17-4',
            'description' => 'Descripción de las propiedades',
            'weight' => '14',
            'cost' => '3.5',
            'price' => '4.14',
            'max_size' => '5.40',
            'category_id' => '7',
            ]
        ,
            [
            'title'      =>  '17/5',
            'slug'     =>  '17-5',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '5.86',
            'max_size' => '6.1',
            'category_id' => '7',
            ]
        ,
            [
            'title'      =>  'K-2',
            'slug'     =>  'K-2',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '3.89',
            'max_size' => '3.2',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-3',
            'slug'     =>  'K-3',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.09',
            'max_size' => '3.6',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-4',
            'slug'     =>  'K-4',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.28',
            'max_size' => '4.1',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-5',
            'slug'     =>  'K-5',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.38',
            'max_size' => '4.3',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-6',
            'slug'     =>  'K-6',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.47',
            'max_size' => '4.5',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-7',
            'slug'     =>  'K-7',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.58',
            'max_size' => '4.80',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-8',
            'slug'     =>  'K-8',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.68',
            'max_size' => '5.1',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-9',
            'slug'     =>  'K-9',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.78',
            'max_size' => '5.3',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-10',
            'slug'     =>  'K-10',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.83',
            'max_size' => '5.5',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-11',
            'slug'     =>  'K-11',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.87',
            'max_size' => '5.9',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-12',
            'slug'     =>  'K-12',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '5.06',
            'max_size' => '6.1',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-13',
            'slug'     =>  'K-13',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '5.64',
            'max_size' => '6.3',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-14',
            'slug'     =>  'K-14',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '6.23',
            'max_size' => '6.55',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-15',
            'slug'     =>  'K-15',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '6.81',
            'max_size' => '7.35',
            'category_id' => '8',
            ]
        ,
            [
            'title'      =>  'K-2',
            'slug'     =>  'K--2',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '3.89',
            'max_size' => '3.2',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-3',
            'slug'     =>  'K--3',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.09',
            'max_size' => '3.6',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-4',
            'slug'     =>  'K--4',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.28',
            'max_size' => '4.1',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-5',
            'slug'     =>  'K--5',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.38',
            'max_size' => '4.3',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-6',
            'slug'     =>  'K--6',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.47',
            'max_size' => '4.5',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-7',
            'slug'     =>  'K--7',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.58',
            'max_size' => '4.80',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-8',
            'slug'     =>  'K--8',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.68',
            'max_size' => '5.1',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-9',
            'slug'     =>  'K--9',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.78',
            'max_size' => '5.3',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-10',
            'slug'     =>  'K--10',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.83',
            'max_size' => '5.5',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-11',
            'slug'     =>  'K--11',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '4.87',
            'max_size' => '5.9',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-12',
            'slug'     =>  'K--12',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '5.06',
            'max_size' => '6.1',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-13',
            'slug'     =>  'K--13',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '5.64',
            'max_size' => '6.3',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-14',
            'slug'     =>  'K--14',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '6.23',
            'max_size' => '6.55',
            'category_id' => '9',
            ]
        ,
            [
            'title'      =>  'K-15',
            'slug'     =>  'K--15',
            'description' => 'Descripción de las propiedades',
            'weight' => '16',
            'cost' => '3.8',
            'price' => '6.81',
            'max_size' => '7.35',
            'category_id' => '9',
            ]
        ,
        ]);
    }
}