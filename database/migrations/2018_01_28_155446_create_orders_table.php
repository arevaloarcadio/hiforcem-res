<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('creator_id')->nullable();
            $table->unsignedInteger('last_update')->nullable();
            $table->unsignedInteger('ship_id')->value(0)->nullable();
            $table->string('address')->nullable();
            $table->string('NIF')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('razon')->nullable();
            $table->string('city')->nullable();
            $table->string('pc')->nullable();
            $table->string('province')->nullable();
            $table->boolean('ship')->nullable();
            $table->date('date')->nullable();
            $table->decimal('shipping_cost',8,2)->nullable();
            $table->string('transporter')->nullable();
            $table->string('matricula')->nullable();
            $table->string('remolque')->nullable();
            $table->integer('palos')->nullable();
            $table->string('obra')->nullable();
            $table->date('delivery_date')->nullable();
            $table->decimal('delivery_comission',8,2)->nullable();
            $table->decimal('ship_extra',8,2)->default(0);
            $table->text('comment')->nullable();
            $table->enum('status',['pendiente','aceptado','entregado']);
            $table->boolean('paid')->default(false);
            $table->unsignedInteger('solicitud')->nullable()->unique();
            $table->unsignedInteger('albaran')->nullable()->unique();
            $table->unsignedInteger('factura')->nullable()->unique();
            $table->string('code')->nullable();
            $table->integer('comercial_comission')->nullable();
            $table->integer('comercial_id')->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->decimal('totalEnvio',8,2)->nullable();
            $table->text('transaction')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
