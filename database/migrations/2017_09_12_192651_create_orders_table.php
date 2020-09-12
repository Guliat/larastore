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
            // ID
            $table->increments('id');
            // IF REGISTERED USER SUBMIT ORDER
            $table->unsignedInteger('user_id')->nullable();
            // IF GUEST USER SUBMIT ORDER
            $table->string('names')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedSmallInteger('zone_id')->nullable();
            $table->string('address')->nullable();
            // FINISHING ORDER
            $table->unsignedTinyInteger('payment_id')->default('1');
            $table->unsignedTinyInteger('shipping_id')->default('1');
            $table->text('comment')->nullable();
            // IS ORDER FINISHED
            $table->unsignedTinyInteger('is_active')->default('1');
            // TIMESTAMPS
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
