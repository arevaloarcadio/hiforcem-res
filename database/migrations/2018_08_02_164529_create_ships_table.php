<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',['Vacio','Incompleto','Completo']);
            $table->decimal('weight',8,2)->nullable();
            $table->enum('weights',['15000','25000']);
            $table->string('transporter')->nullable();
            $table->string('matricula')->nullable();
            $table->string('remolque')->nullable();
            $table->decimal('shipping_cost',8,2)->nullable();
            $table->unsignedInteger('order1')->nullable();
            $table->unsignedInteger('order2')->nullable();
            $table->unsignedInteger('order3')->nullable();
            $table->unsignedInteger('order4')->nullable();
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
        Schema::dropIfExists('ships');
    }
}
