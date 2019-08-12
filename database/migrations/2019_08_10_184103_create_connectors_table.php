<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connectors', function (Blueprint $table) {
            // 初回入力　必須項目
            $table->increments('id');
            $table->string('name');
            $table->string('furigana');

            // null可
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('mark')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('mail')->nullable();
            $table->integer('connect_method')->nullable();
            $table->integer('is_student')->nullable();
            $table->integer('total_count')->nullable();
            $table->date('current_use_date')->nullable();
            $table->text('special')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connectors');
    }
}
