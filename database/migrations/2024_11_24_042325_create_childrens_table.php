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
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('children_group_id')->nullable(true);
            $table->string('first_name')->nullable(true);
            $table->string('middle_name')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('blood_type')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->decimal('height', 8, 2)->nullable(true);
            $table->decimal('weight', 8, 2)->nullable(true);
            $table->date('dob')->nullable(true);
            $table->date('doa')->nullable(true);
            $table->integer('is_foundling')->default('0');
            $table->string('father_name')->nullable(true);
            $table->string('mother_name')->nullable(true);
            $table->string('guardian_name')->nullable(true);
            $table->string('csf')->nullable(true);//case study file
            $table->string('poe')->nullable(true);//proof of efforts
            $table->string('cof')->nullable(true);//certificate of foundling
            $table->string('cola')->nullable(true);//certificate of legal adoption
            $table->string('cfsc')->nullable(true);//certificate for surrendered child
            $table->string('bc')->nullable(true);//birth cert
            $table->string('admission_photo')->nullable(true);
            $table->string('latest_photo')->nullable(true);
            $table->string('notes')->nullable(true);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();

            $table->foreign('children_group_id')->references('id')->on('children_groups')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childrens');
    }
};
