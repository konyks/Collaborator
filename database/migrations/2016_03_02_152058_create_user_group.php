<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateUserGroup
 *
 * Created by: Serhiy Konyk
 */
class CreateUserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_group');
    }
}
