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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description_short')->nullable();
            $table->string('description_long')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_spotify')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_press')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
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
        Schema::dropIfExists('artists');
    }
};
