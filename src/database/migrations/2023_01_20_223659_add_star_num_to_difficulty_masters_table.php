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
        Schema::table('difficulty_masters', function (Blueprint $table) {
            $table->tinyInteger('star_num')->unsigned()->after('exp')->comment('難易度★の数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('difficulty_masters', function (Blueprint $table) {
            $table->dropColumn('star_num');
        });
    }
};
