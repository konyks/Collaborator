<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreatePosts
 *
 * Created by: Serhiy Konyk
 */
class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('user_id');
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->text('body');
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
        Schema::drop('posts');
    }
}
