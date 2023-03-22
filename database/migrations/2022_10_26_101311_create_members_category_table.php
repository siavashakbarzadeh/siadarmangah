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
        Schema::create('members_category', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100)->nullable();
            $table->integer('quota')->nullable();
            $table->boolean('biennial')->nullable();
            $table->integer('contribution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_category');
    }
};
