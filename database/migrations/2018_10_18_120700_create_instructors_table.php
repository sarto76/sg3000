<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('init',2);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('email',100);
            $table->date('birthdate');
            $table->string('mobile',100);
            $table->string('password',100);
            $table->string('session',200);
            $table->integer('user_status_id');
            $table->string('pushover',200);
            $table->string('label',200);
            $table->integer('rank');
            $table->text('image',100);
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
        Schema::dropIfExists('instructors');
    }
}
