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
        Schema::create('counties', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('city', 150)->nullable();
            $table->string('CAP', 5)->nullable();
            $table->string('province', 3)->nullable();
            $table->bigInteger('region')->nullable();
            $table->string('prefix', 4)->nullable();
            $table->string('ISTAT', 8)->nullable();
            $table->string('country', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('county');
    }
};
