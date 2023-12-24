<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('provider_id');
            $table->double('bid_amount');
            $table->enum('pay_status',['Due','Paid'])->default('Due');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('biddings');
    }
}
