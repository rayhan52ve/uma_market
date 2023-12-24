<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikeModelsTable extends Migration
{
    public function up()
    {
        Schema::create('bike_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('brand_id'); // Reference to bike_brands table
            $table->integer('engine_displacement');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('brand_id')->references('id')->on('bike_brands');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bike_models');
    }
}
