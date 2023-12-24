<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users');
            $table->integer('daily_target')->default(0);
            $table->integer('target_achive')->default(0);
            $table->integer('target_extra_achive')->default(0);
            $table->integer('target_non_achive')->default(0);
            $table->integer('total_final_achive')->default(0);
            $table->integer('final_non_achive')->default(0);
            $table->string('attendence_selfie')->nullable();
            $table->integer('bonus_point')->default(0);
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
        Schema::dropIfExists('worksheets');
    }
}
