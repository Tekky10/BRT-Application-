<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrtEtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brt_etas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('dest_id');
            $table->string('distance');
            $table->string('time');
            $table->string('speed');
            $table->timestamps();

            $table->unique(['route_id','dest_id']);
            //$table->foreign('route_id')->references('id')->on('routes');
            //$table->foreign('dest_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brt_etas');
    }
}
