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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('companyName',100);
            $table->string('address', 100)->nullable();
            $table->string('code', 50)->nullable();
            $table->string('city',4)->nullable();
            $table->string('telephone1', 15)->nullable();
            $table->string('telephone2', 15)->nullable();
            $table->string('fax', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
