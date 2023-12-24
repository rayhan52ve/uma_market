<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazorpayPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razorpay_payments', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('theme_color')->nullable();
            $table->double('currency_rate')->default(1);
            $table->string('currency_code')->nullable();
            $table->string('country_code')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('razorpay_payments');
    }
}
