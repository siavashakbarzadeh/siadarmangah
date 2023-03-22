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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('operation_date')->nullable();
            $table->string('reason', 30)->nullable();
            $table->double('quota_amount')->nullable();
            $table->double('amount_paid')->nullable();
            $table->tinyInteger('registration_type')->nullable();
            $table->string('year_of_reference', 50)->nullable();
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
        Schema::dropIfExists('payment_histories');
    }
};
