<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->integer('position')->nullable();
                $table->integer('user_id');
                $table->string('category_id')->nullable();
                $table->string('title')->nullable();
                $table->string('slug')->nullable(); 
                $table->longtext('content')->nullable();
                $table->longtext('content_css')->nullable();
                $table->longtext('excerpt')->nullable();
                $table->string('thumbnail_path')->nullable();
                $table->string('post_type')->nullable();
                $table->string('status')->nullable();
                $table->string('option_1')->nullable(); 
                $table->string('option_2')->nullable(); 
                $table->string('option_3')->nullable(); 
                $table->string('option_4')->nullable(); 
                $table->string('more_option_1')->nullable(); 
                $table->longtext('more_option_2')->nullable(); 
                $table->string('gallery_img')->nullable(); 
                $table->string('template')->nullable(); 
                $table->string('trash')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
