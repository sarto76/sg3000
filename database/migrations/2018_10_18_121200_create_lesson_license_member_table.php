<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonLicenseMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_license_member', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lesson_id')->unsigned();
            $table->text('notes')->nullable(true);
            $table->integer('license_member_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('license_member_id')->references('id')->on('license_member')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_license_member');
    }
}
