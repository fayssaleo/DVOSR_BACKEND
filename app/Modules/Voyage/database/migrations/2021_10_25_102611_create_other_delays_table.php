<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDelaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_delays', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->dateTime("from");
            $table->dateTime("to");
            $table->text("reason");
            $table->text("comment")->nullable();
            $table->string("dep_arr");
            $table->string("code");
            $table->string("category");
            $table->bigInteger('voyage_id')->unsigned();
            $table->foreign('voyage_id')->references('id')->on('voyages')
                ->onDelete('cascade');
            $table->bigInteger('crane_id')->unsigned();
            $table->foreign('crane_id')->references('id')->on('cranes')
                ->onDelete('cascade');
            $table->bigInteger('code_id')->unsigned()->nullable();
            $table->foreign('code_id')->references('id')->on('codes')
                ->onDelete('set null');
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
        Schema::dropIfExists('other_delays');
    }
}
