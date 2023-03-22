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
        Schema::create('frequency_member_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frequency_id')->references('id')->on('frequencies');
            $table->foreignId('member_type')->references('id')->on('participant_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequency_member_type');
    }
};
