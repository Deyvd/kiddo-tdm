<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTableStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->enum('status', ['a', 'i'])->nullable()->after('class_group_id');
            $table->enum('assigned',['y','n'])->nullable()->after('status');
            $table->dateTime('started')->nullable()->after('assigned');
            $table->dateTime('ended')->nullable()->after('started');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('assigned');
            $table->dropColumn('started');
            $table->dropColumn('ended');

        });
    }
}
