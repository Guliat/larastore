<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategorySubcategoryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('category', 'name');
        });    
        Schema::table('subcategories', function (Blueprint $table) {
            $table->renameColumn('subcategory', 'name');
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
            $table->renameColumn('name', 'category');
        });    
        Schema::table('subcategories', function (Blueprint $table) {
            $table->renameColumn('name', 'subcategory');
        });  
    }
}
