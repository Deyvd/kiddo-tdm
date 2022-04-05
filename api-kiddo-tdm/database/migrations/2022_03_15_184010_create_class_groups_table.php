<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_groups', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->unsignedBigInteger('class_day_id');
            $table->unsignedBigInteger('shedule_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('room_id');

            $table->timestamps();

            $table->foreign('class_day_id')->references('id')->on('class_days');
            $table->foreign('shedule_id')->references('id')->on('shedules');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_groups');
    }
}
