<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->string('start_location')->nullable();
            $table->string('end_location')->nullable();
            $table->date('starting_date')->nullable();
            $table->string('starting_time')->nullable();
            $table->string('passenger_count')->nullable();
            $table->enum('trip_type', ['single', 'up-down'])->nullable();
            $table->enum('ac_type', ['ac', 'none-ac'])->nullable();
            $table->string('duration_month')->nullable();
            $table->string('duration_day')->nullable();
            $table->string('duration_hour')->nullable();
            $table->longText('rent_description')->nullable();
            $table->string('patient_type')->nullable();
            $table->enum('life_support_type', ['basic', 'advance'])->nullable();
            $table->string('receiver_mobile')->nullable();
            $table->unsignedBigInteger('truck_type')->nullable();
            $table->string('ton')->nullable();
            $table->string('feet')->nullable();
            $table->longText('product_description')->nullable();
            $table->tinyInteger('second_load')->nullable();
            $table->string('second_load_location')->nullable();
            $table->string('second_unload_location')->nullable();
            $table->string('second_provider_mobile')->nullable();
            $table->string('second_receiver_mobile')->nullable();
            $table->tinyInteger('third_load')->nullable();
            $table->string('third_load_location')->nullable();
            $table->string('third_unload_location')->nullable();
            $table->string('third_provider_mobile')->nullable();
            $table->string('third_receiver_mobile')->nullable();
            $table->longText('product_tags')->nullable();
            $table->tinyInteger('without_driver')->nullable();
            $table->string('customer_full_name')->nullable();
            $table->longText('customer_address')->nullable();
            $table->string('customer_nid_no')->nullable();
            $table->string('customer_nid_image_front')->nullable();
            $table->string('customer_nid_image_back')->nullable();
            $table->string('customer_driving_license_image_front')->nullable();
            $table->string('customer_driving_license_image_back')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->string('parent_nid_no')->nullable();
            $table->string('parent_nid_image_front')->nullable();
            $table->string('parent_nid_image_back')->nullable();
            $table->enum('status', ['ordered', 'in-progress', 'completed', 'canceled'])->default('ordered');

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
        Schema::dropIfExists('trip_infos');
    }
}
