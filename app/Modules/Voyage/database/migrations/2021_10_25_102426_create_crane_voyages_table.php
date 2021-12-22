<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCraneVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crane_voyages', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->dateTime("cbd")->nullable();
            $table->dateTime("dgbohc_bfl_from")->nullable();
            $table->dateTime("dgbohc_bfl_to")->nullable();
            $table->integer("dgbohc_bfl_num_gb")->nullable();
            $table->integer("dgbohc_bfl_num_hc")->nullable();
            $table->dateTime("dss_bfl_from")->nullable();
            $table->dateTime("dss_bfl_to")->nullable();
            $table->integer("dss_bfl_num_sp")->nullable();
            $table->string("dss_bfl_fb_dnw")->nullable();
            $table->integer("dss_bfl_fb")->nullable();
            $table->dateTime("ffl")->nullable();
            $table->dateTime("fll")->nullable();
            $table->dateTime("sfl")->nullable();
            $table->dateTime("sll")->nullable();
            $table->dateTime("tfl")->nullable();
            $table->dateTime("tll")->nullable();
            $table->dateTime("lgbohc_all_from")->nullable();
            $table->dateTime("lgbohc_all_to")->nullable();
            $table->integer("lgbohc_all_num_gb")->nullable();
            $table->integer("lgbohc_all_hc")->nullable();
            $table->integer("lgbohc_all_inbay")->nullable();

            $table->dateTime("lss_all_from")->nullable();
            $table->dateTime("lss_all_to")->nullable();
            $table->integer("lss_all_num_ss")->nullable();
            $table->string("lss_all_ib_lnw")->nullable();
            $table->integer("lss_all_ib")->nullable();
            $table->dateTime("cbu")->nullable();
            $table->bigInteger('voyage_id')->unsigned();
            $table->foreign('voyage_id')->references('id')->on('voyages')
                ->onDelete('cascade');
            $table->bigInteger('crane_id')->unsigned();
            $table->foreign('crane_id')->references('id')->on('cranes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('crane_voyages');
    }
}
