<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("voyage_number")->nullable();
            $table->boolean("vawgd")->nullable();
            $table->boolean("vawsnrog")->nullable();
            $table->boolean("dm_y")->nullable();
            $table->boolean("dm_g")->nullable();
            $table->integer("hatch_covers_num")->nullable();
            $table->integer("hatch_covers_moves")->nullable();
            $table->integer("gear_boxes_num")->nullable();
            $table->integer("gear_boxes_moves")->nullable();
            $table->dateTime("first_line_datetime")->nullable();
            $table->dateTime("vessel_all_fast")->nullable();
            $table->dateTime("gangway_secured")->nullable();
            $table->dateTime("lashers_onboard")->nullable();
            $table->integer("num_mooring_r_fore")->nullable();
            $table->integer("num_mooring_r_aft")->nullable();
            $table->boolean("dwuscfb")->nullable();
            $table->boolean("imo_class")->nullable();
            $table->string("imo_class_ps_onb")->nullable();
            $table->dateTime("last_lift_from")->nullable();
            $table->dateTime("last_lift_to")->nullable();
            $table->text("last_lift_comment")->nullable();
            $table->dateTime("lf_from")->nullable();
            $table->dateTime("lf_to")->nullable();
            $table->text("lf_comment")->nullable();
            $table->dateTime("agent_onboard_from")->nullable();
            $table->dateTime("agent_onboard_to")->nullable();
            $table->text("agent_onboard_comment")->nullable();
            $table->dateTime("safety_net_gangway_from")->nullable();
            $table->dateTime("safety_net_gangway_to")->nullable();
            $table->text("safety_net_gangway_comment")->nullable();
            $table->dateTime("pilot_onboard_from")->nullable();
            $table->dateTime("pilot_onboard_to")->nullable();
            $table->text("pilot_onboard_comment")->nullable();
            $table->dateTime("tugs_arrived_from")->nullable();
            $table->dateTime("tugs_arrived_to")->nullable();
            $table->text("tugs_arrived_comment")->nullable();
            $table->dateTime("unmooring_forward_from")->nullable();
            $table->dateTime("unmooring_forward_to")->nullable();
            $table->text("unmooring_forward_comment")->nullable();
            $table->dateTime("unmooring_aft_from")->nullable();
            $table->dateTime("unmooring_aft_to")->nullable();
            $table->text("unmooring_aft_comment")->nullable();
            $table->dateTime("last_line_from")->nullable();
            $table->dateTime("last_line_to")->nullable();
            $table->text("last_line_comment")->nullable();
            $table->boolean("pgb_r_co")->nullable();
            $table->string("pgb_r_co_reason")->nullable();
            $table->bigInteger('vessel_id')->unsigned();
            $table->foreign('vessel_id')->references('id')->on('vessels')
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
        Schema::dropIfExists('voyages');
    }
}
