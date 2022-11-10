<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('release_date');
            $table->string('venue');
            $table->string('city');
            $table->string('country');
            $table->string('latitude');
            $table->string('longitude');
            $table->dateTime('date');
            $table->time('duration');
            $table->string('status');
            $table->string('label');
            $table->string('note');
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
        Schema::dropIfExists('dates');
    }
};
