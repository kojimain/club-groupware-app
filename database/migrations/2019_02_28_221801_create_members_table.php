<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table
                ->foreign('club_id')->references('id')->on('clubs')
                ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table
                ->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->unique(['club_id', 'user_id'], 'club_user_index');
            $table->string('role_type');
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
        Schema::dropIfExists('members');
    }
}
