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
        Schema::create('fee_details', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('month');
            $table->string('desc');
            $table->integer('late_fee');
            $table->integer('amount');
            // $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('fee_id')->nullable();
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
        Schema::dropIfExists('fee_details');
    }
};
