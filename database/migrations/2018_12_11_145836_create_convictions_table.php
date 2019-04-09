<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id');
            $table->string('county');
            $table->string('docket');
            $table->date('con_date');
            $table->text('incident');
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
        Schema::dropIfExists('convictions');
    }
}
