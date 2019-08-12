<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // 必須項目
            $table->increments('id');
            $table->integer('connector_id')->unsigned();
            $table->string('name');
            $table->string('furigana');

            // null可
            $table->integer('age');
            $table->integer('height');
            $table->integer('body_type');

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
        Schema::dropIfExists('customers');
    }
}
