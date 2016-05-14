<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateGroupsTable
 *
 * Created by: Serhiy Konyk
 */
class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('department');
            $table->string('description');
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
        Schema::drop('groups');
    }
}
