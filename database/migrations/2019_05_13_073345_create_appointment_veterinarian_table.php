<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentVeterinarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_veterinarian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('appointment_id')->unsigned();
            $table->bigInteger('veterinarian_id')->unsigned();

            $table->foreign('appointment_id')->references('id')->on('appointments');
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_veterinarian');
    }
}
