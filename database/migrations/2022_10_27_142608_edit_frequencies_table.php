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
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('credit_type')->nullable();
            $table->foreignId('member_type')->nullable()->references('id')->on('participant_role');
            $table->double('value')->nullable();
            $table->string('sponsor', 200)->nullable();
            $table->dateTime('credits_earned_date')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
