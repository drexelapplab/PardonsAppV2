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
            $table->date('inc_date');
            $table->date('arr_date');
            $table->text('incident');
            $table->text('offense1');
            $table->text('offense2')->nullable();;
            $table->text('offense3')->nullable();;
            $table->text('offense4')->nullable();;
            $table->text('offense5')->nullable();;
            $table->text('offense6')->nullable();;
            $table->text('offense7')->nullable();;
            $table->text('offense8')->nullable();;
            $table->text('offense9')->nullable();;
            $table->text('offense10')->nullable();;
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
