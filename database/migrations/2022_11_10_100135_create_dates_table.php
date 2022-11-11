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
            $table->foreignId('event_id')->nullable()->constrained('events');
            $table->foreignId('venue_id')->nullable()->constrained('venues');
            $table->dateTime('release_date')->nullable();
            $table->dateTime('date')->nullable();
            $table->time('duration')->nullable();
            $table->string('status')->nullable();
            $table->string('label')->nullable();
            $table->string('note')->nullable();
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
