<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateMeetingTable
 *
 * Created by: Serhiy Konyk
 */
class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('group_id')->index();
            $table->dateTime('time');
            $table->string('location');
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
        Schema::drop('meetings');
    }
}
