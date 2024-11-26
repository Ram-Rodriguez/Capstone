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
        Schema::create('court_appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('appointment_date');
            $table->unsignedBigInteger('child_id')->nullable(true);
            $table->unsignedBigInteger('employee_id')->nullable(true);
            $table->string('title');
            $table->string('details')->nullable(true);
            $table->integer('csf')->default('0')->nullable(true);
            $table->integer('poe')->default('0')->nullable(true);
            $table->integer('cof')->default('0')->nullable(true);
            $table->integer('cola')->default('0')->nullable(true);
            $table->integer('cfsc')->default('0')->nullable(true);
            $table->integer('bc')->default('0')->nullable(true);
            $table->integer('admission_photo')->default('0')->nullable(true);
            $table->integer('latest_photo')->default('0')->nullable(true);
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('childrens')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_appointments');
    }
};
