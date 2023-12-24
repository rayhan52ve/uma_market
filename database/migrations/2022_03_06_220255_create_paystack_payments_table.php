<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaystackPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paystack_payments', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('public_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->double('currency_rate')->default(1);
            $table->string('country_code')->nullable();
            $table->string('currency_code')->nullable();
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
        Schema::dropIfExists('paystack_payments');
    }
}
