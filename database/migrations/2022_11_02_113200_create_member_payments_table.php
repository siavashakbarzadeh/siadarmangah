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
        Schema::create('member_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->date('date')->nullable();
            $table->string('payment_reason', 30)->nullable();
            $table->double('amount')->nullable();
            $table->double('payed_amount')->nullable();
            $table->foreignId('payment_type_id')->nullable();
            $table->string('year', 50)->nullable();
            $table->tinyInteger('paid')->nullable();
            $table->date('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_payments');
    }
};
