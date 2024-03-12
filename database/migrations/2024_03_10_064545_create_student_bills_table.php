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
        Schema::create('student_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('quantity');
            $table->string('desc');
            $table->integer('fee');
            $table->integer('sum_fee');
            $table->integer('total_fee');
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
        Schema::dropIfExists('student_bills');
    }
};
