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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course', 150)->nullable();
            $table->string('event_code', 20)->nullable();
            $table->integer('edition_code')->nullable();
            $table->string('organizer_code',20)->nullable();
            $table->foreignId('accreditor_code')->nullable()->references('id')->on('accreditors');
            $table->string('reference_number', 50)->nullable();
            $table->string('place', 50)->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->integer('course_hours')->nullable();
            $table->double('course_credits')->nullable();
            $table->integer('education')->nullable();
            $table->string('fad', 1)->nullable();
            $table->string('fre', 1)->nullable();
            $table->string('fsc', 1)->nullable();
            $table->string('event_type', 255)->nullable();
            $table->foreignId('goal_id')->nullable()->references('id')->on('goals');
            $table->integer('attendees_number')->nullable();
            $table->dateTime('validation_date')->nullable();
            $table->foreignId('scientific_head')->nullable()->references('id')->on('members');
            $table->string('telephone', 18)->nullable();
            $table->string('organizational_secretariat', 100)->nullable();
            $table->string('reference_name', 50)->nullable();
            $table->string('reference_telephone_number', 18)->nullable();
            $table->double('amount')->nullable();
            $table->string('letter_amount', 80)->nullable();
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
        Schema::dropIfExists('courses');
    }
};
