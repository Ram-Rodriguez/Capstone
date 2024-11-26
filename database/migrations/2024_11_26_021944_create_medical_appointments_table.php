<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('appointment_date');
            $table->unsignedBigInteger('child_id')->nullable(true);
            $table->string('title');
            $table->string('details')->nullable(true);
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('childrens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_appointments');
    }
};
