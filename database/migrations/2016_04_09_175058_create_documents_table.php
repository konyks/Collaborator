<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateDocumentsTable
 *
 * Created by: Serhiy Konyk
 */
class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function(Blueprint $table){
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('path');
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
        Schema::drop('documents');
    }
}
