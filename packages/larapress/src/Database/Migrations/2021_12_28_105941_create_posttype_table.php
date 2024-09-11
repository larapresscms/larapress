<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posttypes')) {
            Schema::create('posttypes', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id'); 
                $table->integer('category_main_id');  
                $table->string('name');
                $table->string('slug');  
                $table->longtext('pt_content')->nullable();  
                $table->longtext('pt_content_css')->nullable(); 
                $table->string('pt_thumbnail_path')->nullable();
                $table->string('status');
                $table->string('category_id');
                $table->string('title');
                $table->string('content');
                $table->string('excerpt');
                $table->string('thumbnail_path'); 
                $table->string('option_1'); 
                $table->string('option_2'); 
                $table->string('option_3'); 
                $table->string('option_4'); 
                $table->string('more_option_1'); 
                $table->string('more_option_2'); 
                $table->string('gallery_img'); 
                $table->string('trash')->nullable();
                $table->string('in_menu_swh');            
                $table->string('menu_icon')->nullable();   
                $table->string('in_dashboard');    
                $table->integer('paginate')->nullable();                 
                $table->integer('template')->nullable();                       
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
        Schema::dropIfExists('posttypes');
    }
}
