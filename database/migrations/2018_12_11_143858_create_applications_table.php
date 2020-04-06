<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('ssn')->nullable();
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->string('address_time')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->default('PA');
            $table->string('zipcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('representation')->nullable();
            $table->string('rep_name')->nullable();
            $table->string('rep_address')->nullable();
            $table->string('rep_address2')->nullable();
            $table->string('rep_city')->nullable();
            $table->string('rep_state')->nullable();
            $table->string('rep_zip')->nullable();
            $table->string('rep_phone')->nullable();
            $table->string('rep_email')->nullable();
            $table->string('job_how_long')->nullable();
            $table->string('retschool_status', 3)->nullable();
            $table->string('trade_status', 3)->nullable();
            $table->string('course_status', 3)->nullable();
            $table->string('crime_drink', 3)->nullable();
            $table->string('drink_status', 3)->nullable();
            $table->string('drink_time')->nullable();
            $table->string('drugs_time')->nullable();
            $table->text('course_descr')->nullable();
            $table->string('course_cert', 3)->nullable();
            $table->string('con_status', 3)->nullable();
            $table->text('con_descr')->nullable();
            $table->text('rec_status', 3)->nullable();
            $table->string('vol_status', 3)->nullable();
            $table->string('rel_status', 3)->nullable();
            $table->string('school_volstatus', 3)->nullable();
            $table->string('school_volname')->nullable();
            $table->string('school_volrec')->nullable();
            $table->string('comm_status', 3)->nullable();
            $table->string('comm_descr')->nullable();
            $table->string('comm_rec', 3)->nullable();
            $table->string('comm_otherstatus', 3)->nullable();
            $table->text('comm_otherdescr')->nullable();
            $table->text('not_repeat')->nullable();
            $table->text('choice')->nullable();
            $table->text('teach')->nullable();
            $table->string('aaprogram_status', 3)->nullable();
            $table->string('aaprogram_start')->nullable();
            $table->string('aaprogram_still')->nullable();
            $table->string('aaprogram_stopped')->nullable();
            $table->string('aaprogram_how')->nullable();
            $table->string('aaprogram_helped')->nullable();
            $table->string('aaprogram_descr')->nullable();
            $table->string('conv_difficult')->nullable();
            $table->string('conv_job')->nullable();
            $table->text('conv_descr')->nullable();
            $table->string('pardon_reasons')->nullable();
            $table->string('difficult_status', 3)->nullable();
            $table->text('difficult_descr')->nullable();
            $table->string('jobdenied_status', 3)->nullable();
            $table->string('jobdenied_descr')->nullable();
            $table->string('other_incidents', 3)->nullable();
            $table->string('harrasment')->nullable();
            $table->string('drinking')->nullable();
            $table->string('conduct')->nullable();
            $table->text('narrative')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('applications');
    }
}
