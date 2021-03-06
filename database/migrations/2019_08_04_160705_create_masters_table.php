<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            // 必須項目
            $table->increments('id');
            $table->integer('rank');
            $table->string('name');
            $table->string('furigana');
            $table->string('zip_code');
            $table->string('address');

            // null可
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('mail')->nullable();
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
        Schema::dropIfExists('masters');
    }
}
