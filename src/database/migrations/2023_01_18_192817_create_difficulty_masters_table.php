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
        Schema::create('difficulty_masters', function (Blueprint $table) {
            $table->id();
            $table->string('difficulty')->comment('難易度:やさしい、ふつう、むずかしい');
            $table->integer('exp')->unsigned()->comment('経験値');
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
        Schema::dropIfExists('difficulty_masters');
    }
};
