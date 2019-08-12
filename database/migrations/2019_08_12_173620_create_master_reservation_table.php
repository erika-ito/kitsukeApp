<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_reservation', function (Blueprint $table) {
            $table->integer('reservation_id')->unsigned();
            $table->integer('master_id')->unsigned();
            
            // 複合主キー設定
            $table->primary(['reservation_id', 'master_id']);

            // 外部キー設定
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->foreign('master_id')->references('id')->on('masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_reservation');
    }
}
