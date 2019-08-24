<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToCustomerReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_reservation', function (Blueprint $table) {
            $table->integer('kimono_type')->nullable()->change();
            $table->integer('obi_type')->nullable()->change();
            $table->integer('obi_knot')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_reservation', function (Blueprint $table) {
            $table->integer('kimono_type')->change();
            $table->integer('obi_type')->change();
            $table->integer('obi_knot')->change();
        });
    }
}
