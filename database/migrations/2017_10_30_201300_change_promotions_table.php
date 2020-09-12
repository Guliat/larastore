<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->after('id');
            $table->decimal('price', 10, 2)->after('product_id');
            $table->datetime('start')->after('price');
            $table->datetime('end')->after('start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('price');
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
