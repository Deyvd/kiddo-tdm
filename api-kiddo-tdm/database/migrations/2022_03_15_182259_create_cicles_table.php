<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicles', function (Blueprint $table) {
            $table->id();
            $table->enum('level', ['workshop', 'beginner_musician', 'instrumentalization']);
            $table->integer('min_age');
            $table->integer('max_age');
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
        Schema::dropIfExists('cicles');
    }
}
