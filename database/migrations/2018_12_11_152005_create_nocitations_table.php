<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNocitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nocitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->date('citation_date');
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
        Schema::dropIfExists('nocitations');
    }
}
