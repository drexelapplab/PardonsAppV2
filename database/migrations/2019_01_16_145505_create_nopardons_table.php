<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNopardonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nopardons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->date('nopardons_date');
            $table->string('level');
            $table->text('offense');
            $table->text('sentence');
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
        Schema::dropIfExists('nopardons');
    }
}
