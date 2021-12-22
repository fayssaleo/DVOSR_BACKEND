<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("actionType");
            $table->string("shift");

            $table->bigInteger('utilisateur_id')->unsigned();
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')
                ->onDelete('cascade');

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
        Schema::dropIfExists('actions');
    }
}
