<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('product_id');
            $table->string('title')->nullable();
            $table->unsignedInteger('user_id');
            $table->decimal('discount',8,2)->nullable();
            $table->decimal('size',8,2)->nullable();
            $table->decimal('weight',8,2)->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->decimal('totalEnvio',8,2)->nullable();
            $table->decimal('bruto',8,2)->nullable();
            $table->decimal('mano',8,2)->nullable();
            $table->decimal('cost',8,2)->nullable();
            $table->decimal('comission',8,2)->nullable();
            $table->date('date')->nullable();
            $table->text('options')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('commercial_id')->nullable();
            $table->boolean('commercial')->nullable();
            $table->integer('qty');
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
        Schema::dropIfExists('items');
    }
}
