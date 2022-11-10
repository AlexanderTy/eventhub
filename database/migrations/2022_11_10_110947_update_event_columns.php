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
        //
        Schema::table('events', function (Blueprint $table) {
            $table->string('sub_title')->nullable()->change();
            $table->dateTime('sale_start')->nullable()->change();
            $table->dateTime('sale_end')->nullable()->change();
            $table->boolean('public')->default(0)->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
