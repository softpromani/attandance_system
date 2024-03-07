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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('student_image')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};
