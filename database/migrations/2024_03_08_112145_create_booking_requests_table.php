<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('specialization_id');
            $table->integer('user_id');
            $table->integer('patient_id');
            $table->date('selected_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status')->default(0)->comment('0=>pending, 1=>approved, 2=>canceled');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_requests');
    }
};
