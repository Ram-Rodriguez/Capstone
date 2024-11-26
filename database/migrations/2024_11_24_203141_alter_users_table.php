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
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('is_archived')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('users', 'name');
        Schema::dropColumns('users', 'employee_number');
        Schema::dropColumns('users', 'first_name');
        Schema::dropColumns('users', 'middle_name');
        Schema::dropColumns('users', 'last_name');
        Schema::dropColumns('users', 'is_archived');
    }
};
