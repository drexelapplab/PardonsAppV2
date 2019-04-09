<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->string('recommend');
            $table->string('recommend_descr');
            $table->string('recommend_name');
            $table->string('recommend_phone');
            $table->string('recommend_email');
            $table->string('recommend_attach');
            $table->string('recommend_type');
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
        Schema::dropIfExists('recommendations');
    }
}
