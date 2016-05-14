<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Class CreateUsersTable
 *
 * Created by: Serhiy Konyk
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('major')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('user_pic')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::drop('users');
    }
}
