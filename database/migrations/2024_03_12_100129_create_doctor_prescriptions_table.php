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
        Schema::create('doctor_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('doctor_id');
            $table->integer('specialization_id');
            $table->integer('patient_id');
            $table->integer('booking_id');
            $table->text('medicinal_prescription');
            $table->text('medical_advices');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_prescriptions');
    }
};
