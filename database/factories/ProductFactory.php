<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'slug' => $faker->title,
        'description' => $faker->paragraph,
        'weight' => $faker->integer
    ];
});




            $table->string('imagePath')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('weight');
            $table->decimal('cost',8,2);
            $table->unsignedInteger('views');
            $table->unsignedInteger('bought');
            $table->unsignedInteger('category_id');
            $table->decimal('price',8,2);