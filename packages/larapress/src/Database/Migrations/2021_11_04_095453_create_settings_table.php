<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('site_title')->nullable();
                $table->string('sub_title')->nullable();
                $table->string('site_logo')->nullable(); 
                $table->string('fav_icon')->nullable(); 
                $table->string('dashboard_color')->nullable();
                $table->string('text_color')->nullable();
                $table->string('text_hover')->nullable();
                $table->string('theme_url')->nullable(); 
                $table->string('home_url')->nullable(); 
                $table->string('editor')->nullable(); 
                $table->string('header')->nullable(); 
                $table->string('footer')->nullable(); 
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
