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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('subscription_date')->nullable();
            $table->string('member_type', 20)->nullable()->default('NULL');
            $table->foreignId('profession_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('qualification')->nullable();
            $table->foreignId('region_id')->nullable()->constrained();
            $table->foreignId('council_charge_id')->nullable()->references('id')->on('council_charges');
            $table->unsignedBigInteger('cd_regionale')->nullable();
            $table->foreignId('member_category')->nullable()->constrained()->references('id')->on('members_category');
            $table->string('sub_category', 255)->nullable()->default('NULL');
            $table->dateTime('expire')->nullable();
            $table->float('quota')->nullable();
            $table->foreignId('job_type_id')->nullable()->constrained()->references('id')->on('job_types');
            $table->tinyInteger('biennial')->nullable();
            $table->integer('year_paid')->nullable();
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
        Schema::dropIfExists('positions');
    }
};
