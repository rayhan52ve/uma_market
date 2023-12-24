<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMolliePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mollie_payments', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('mollie_key')->nullable();
            $table->integer('status')->default(0);
            $table->double('currency_rate')->default(0);
            $table->string('country_code')->nullable();
            $table->string('currency_code')->nullable();
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
        Schema::dropIfExists('mollie_payments');
    }
}
