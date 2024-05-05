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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->string('name');
            $table->tinyInteger('Gender')->comment('0=>male, 1=>female, 2=>others');
            $table->date('date_of_birth');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('uploads')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
