<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVauchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vauchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->decimal('discount', 5, 2);
            $table->datetime('start');
            $table->datetime('end');
            $table->unsignedTinyInteger('status')->default('0');
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
        Schema::dropIfExists('vauchers');
    }
}
