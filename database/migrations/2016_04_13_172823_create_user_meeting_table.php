<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateUserMeetingTable
 *
 * Created by: Serhiy Konyk
 */
class CreateUserMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meeting', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('meeting_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_meeting');
    }
}
