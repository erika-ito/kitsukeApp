<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reservation', function (Blueprint $table) {
            $table->integer('reservation_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('kimono_type');
            $table->integer('obi_type');
            $table->integer('obi_knot');
            
            // 複合主キー設定
            $table->primary(['reservation_id', 'customer_id']);

            // 外部キー設定
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_reservation');
    }
}
