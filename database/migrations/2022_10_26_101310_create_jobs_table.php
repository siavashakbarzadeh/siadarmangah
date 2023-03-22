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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('office', 60)->nullable()->default('NULL');
            $table->string('head_quarters', 30)->nullable()->default('NULL');
            $table->string('office_city', 30)->nullable()->default('NULL');
            $table->string('cap_office_city', 5)->nullable()->default('NULL');
            $table->string('province_office_city', 2)->nullable();
            $table->string('telephone_3', 15)->nullable()->default('NULL');
            $table->string('telephone_4', 15)->nullable()->default('NULL');
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
        Schema::dropIfExists('jobs');
    }
};
