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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('residence', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('cap', 6)->nullable();
            $table->string('province', 2)->nullable();
            $table->string('telephone1', 15)->nullable();
            $table->string('telephone2', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residencies');
    }
};
