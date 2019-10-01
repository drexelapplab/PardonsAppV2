<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthcrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youthcrimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->string('youth_date');
            $table->string('county');
            $table->string('state');
            $table->string('offense');
            $table->string('adjudicated');
            $table->string('sentence');
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
        Schema::dropIfExists('youthcrimes');
    }
}
