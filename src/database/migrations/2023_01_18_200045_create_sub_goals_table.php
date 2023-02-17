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
        Schema::create('sub_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goal_id')->constrained()->cascadeOnDelete();
            $table->string('title')->comment('タイトル');
            $table->text('detail')->comment('メモ');
            $table->bigInteger('difficulty_master_id')->unsigned();
            $table->foreign('difficulty_master_id')->references('id')->on('difficulty_masters');
            $table->tinyInteger('status')->unsigned()->comment('ステータス: 0:未達成 1:達成');
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
        Schema::dropIfExists('sub_goals');
    }
};
