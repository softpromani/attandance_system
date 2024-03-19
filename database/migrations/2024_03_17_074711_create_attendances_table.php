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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qr_id');
            $table->unsignedBigInteger('teacher_id');
            $table->dateTime('punching_time');
            $table->dateTime('punchout_time')->nullable();
            $table->string('punching_location');
            $table->string('punchout_location')->nullable();
            $table->string('status')->default('0');
            $table->longText('device_info')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
