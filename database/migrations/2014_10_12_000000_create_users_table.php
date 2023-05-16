<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('NIF')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('razon')->nullable();
            $table->string('address')->nullable();
            $table->string('codigo')->nullable();
            $table->string('city')->nullable();
            $table->string('pc')->nullable();
            $table->integer('comercial_id')->nullable();
            $table->integer('comercial_comission')->nullable();
            $table->integer('delivery_comission')->default(5);
            $table->string('province')->nullable();
            $table->boolean('root')->nullable();
            $table->boolean('admin')->nullable();
            $table->boolean('comercial')->nullable();
            $table->boolean('tecnico')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
