<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_municipalities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id')->references('id')->on('shipping_provinces')->onDelete('cascade');
            $table->unsignedBigInteger('district_id')->references('id')->on('ship_districts')->onDelete('cascade');
            $table->string('municipal_name');
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
        Schema::dropIfExists('ship_municipalities');
    }
};
