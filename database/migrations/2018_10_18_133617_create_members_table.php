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
            $table->string('email',50);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('title',50);
            $table->string('address',100);
            $table->integer('zip');
            $table->string('city',100);
            $table->string('phone',50);
            $table->string('mobile',100);
            $table->string('work',100);
            $table->date('birthdate');
            $table->integer('instructor_id');
            $table->integer('user_status_id');
            $table->string('session',200);
            $table->softDeletes();
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
