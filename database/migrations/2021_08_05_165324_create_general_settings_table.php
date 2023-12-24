<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename',50);
            $table->string('site_currency',10);
            $table->string('currency_icon',5);
            $table->string('site_direction');
            $table->string('commision');
            $table->string('employee_target_bonus');
            $table->string('email_method');
            $table->string('smtp_config');
            $table->boolean('user_reg')->default(1);
            $table->boolean('user_reg')->default(1);
            $table->boolean('blog_comment')->default(1);
            $table->string('login_page')->nullable();
            $table->string('logo',50)->nullable();
            $table->string('default_image')->nullable();
            $table->string('service_default_image')->nullable();
            $table->string('icon',50)->nullable();
            $table->string('color',50);
            $table->string('secondary_color',50);
            $table->string('email_from',100);
            $table->string('allow_recaptcha');
            $table->string('recaptcha_key');
            $table->string('recaptcha_secret');
            $table->string('twak_allow');
            $table->string('twak_key');
            $table->string('seo_description');
            $table->string('preloader_status');
            $table->string('preloader_image');
            $table->string('analytics_key');
            $table->string('analytics_status');
            $table->string('fb_app_key');
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
        Schema::dropIfExists('general_settings');
    }
}
