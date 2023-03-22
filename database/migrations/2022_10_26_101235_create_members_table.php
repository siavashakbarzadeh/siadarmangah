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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('qualification', 8)->nullable()->default('NULL');
            $table->string('surname', 30)->nullable()->default('NULL');
            $table->string('name', 30)->nullable()->default('NULL');
            $table->string('gender', 1)->nullable();
            $table->string('birth_place', 8)->nullable();
            $table->foreign('birth_place')->references('id')->on('counties');
            $table->dateTime('birth_date')->nullable();
            $table->string('fiscal_code')->nullable()->default('NULL');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('consent')->nullable()->default(0);
            $table->string('email', 50)->nullable()->default('null');
            $table->text('notes')->nullable();
            $table->tinyInteger('yo_sid')->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('members');
    }
};
