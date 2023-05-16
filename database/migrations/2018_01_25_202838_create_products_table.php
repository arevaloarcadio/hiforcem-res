<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('weight');
            $table->decimal('cost',8,2);
            $table->unsignedInteger('views')->nullable();
            $table->unsignedInteger('bought')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->decimal('price',8,2);
            $table->decimal('mano',8,2)->nullable();
            $table->decimal('max_size',8,2);
            $table->string('imagePath')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
