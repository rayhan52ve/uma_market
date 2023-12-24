<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlutterwavePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flutterwave_payments', function (Blueprint $table) {
            $table->id();
            $table->text('public_key')->nullable();
            $table->text('secret_key')->nullable();
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->integer('status')->default(1);
            $table->double('currency_rate')->default(1);
            $table->string('currency_code')->nullable();
            $table->string('country_code')->nullable();
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
        Schema::dropIfExists('flutterwave_payments');
    }
}
