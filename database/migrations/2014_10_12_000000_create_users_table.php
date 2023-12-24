<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->string('fname');
            $table->string('lname');
            $table->string('username');
            $table->string('slug');
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->unique();
            $table->string('referral')->nullable()->unique();
            $table->string('link_token')->nullable();
            $table->string('mobile_otp_expire_at')->nullable();
            $table->string('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('image')->nullable();
            $table->string('designition')->nullable();
            $table->string('experience')->nullable();
            $table->string('designition')->nullable();
            $table->string('details')->nullable();
            $table->string('featured')->nullable();
            $table->string('bonus')->nullable();
            $table->string('target')->nullable();
            $table->string('social')->nullable();
            $table->string('ev')->nullable();
            $table->string('status');
            $table->string('employee_role')->nullable();
            $table->foreignId('division_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('upazila_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
