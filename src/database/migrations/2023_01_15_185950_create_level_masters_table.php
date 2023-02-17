<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_masters', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('level')->unsigned()->comment('レベル');
            $table->integer('required_exp')->unsigned()->comment('レベルアップに必要な経験値');
            $table->string('avator_url')->comment('アバター格納パス:http://xxxxxx/level_1. png');
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
        Schema::dropIfExists('level_masters');
    }
};
