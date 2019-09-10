<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdultcrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adultcrimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->date('adult_date');
            $table->string('location');
            $table->string('offense');
            $table->string('disposition');
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
        Schema::dropIfExists('adultcrimes');
    }
}
