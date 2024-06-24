<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sponsorcategories', function (Blueprint $table) {
            // Assuming 'category_position' is not already a field in your table
            $table->integer('category_position')->after('id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sponsorcategories', function (Blueprint $table) {
            $table->dropColumn('category_position');
        });
    }
};
