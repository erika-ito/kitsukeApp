<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            // 初回入力　必須項目
            $table->increments('id');
            $table->integer('connector_id')->unsigned();
            $table->integer('status');
            $table->string('user');
            $table->datetime('reservation_date');
            $table->integer('reservation_type');
            $table->integer('reply');
            $table->integer('location_type');
            $table->date('location_date');
            $table->time('finish_time');
            $table->time('start_time');
            $table->integer('count_person');
            $table->integer('count_master');
            $table->string('purpose');

            // null可
            $table->string('location_name')->nullable();
            $table->integer('location_zip_code')->nullable();
            $table->string('location_address')->nullable();
            $table->integer('location_phone')->nullable();
            $table->string('distance')->nullable();
            $table->integer('tool_buying')->nullable();
            $table->integer('total_price')->nullable();
            $table->date('tool_connect_date')->nullable();
            $table->date('tool_confirm_date')->nullable();
            $table->date('master_request_date')->nullable();
            $table->date('tool_pass_date')->nullable();
            $table->integer('payment')->nullable();
            $table->text('thoughts')->nullable();
            $table->text('notes')->nullable();

            // 外部キー設定
            $table->foreign('connector_id')->references('id')->on('connectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
