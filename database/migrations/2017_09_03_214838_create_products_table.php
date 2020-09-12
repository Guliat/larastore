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
            $table->unsignedTinyInteger('category_id')->nullable();
            $table->unsignedTinyInteger('subcategory_id')->nullable();
            // WHO UPLOAD PRODUCT -- EMPLOYEE OR CUSTOMER
            $table->unsignedInteger('uploader_id');
            // STORE WHERE PRODUCT IS
            $table->unsignedTinyInteger('store_id')->default('1');
            $table->string('name');
            $table->text('description');
            $table->string('model')->nullable();
            // FIRST IMAGE -- THUMBNAIL
            $table->string('image')->nullable();
            $table->decimal('buy_price', 10, 2)->nullable();
            $table->decimal('sell_price', 10, 2)->nullable();
            $table->unsignedInteger('quantity')->default('1');
            $table->unsignedTinyInteger('is_active')->default('1');
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
        Schema::dropIfExists('products');
    }
}
