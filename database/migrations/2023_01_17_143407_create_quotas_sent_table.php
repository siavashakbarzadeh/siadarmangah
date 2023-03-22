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
        Schema::create('quotas_sent', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 10);
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('scheda_path', 150)->default(NULL)->nullable();;
            $table->string('courses_path', 150)->default(NULL)->nullable();
            $table->string('email', 150);
            $table->string('region',100);
            $table->string('year',4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotas_sent');
    }
};
