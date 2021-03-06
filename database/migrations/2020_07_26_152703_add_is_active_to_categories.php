<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('categories', function (Blueprint $table) {
           $table->unsignedTinyInteger('is_active')->default('1')->after('slug');
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('categories', function (Blueprint $table) {
           $table->dropColumn('is_active');
       });
     }
}
