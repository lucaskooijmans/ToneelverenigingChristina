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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('starttime');
            $table->dateTime('endtime');
            $table->string('image')->nullable();
            $table->string('location')->default('Dorpshuis de Rozenhoek');
            $table->integer('available_seats');
            $table->integer('tickets_remaining');
            $table->integer('tickets_sold')->default(0);
            $table->integer('tickets_added')->default(0);
            $table->integer('tickets_removed')->default(0);
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
