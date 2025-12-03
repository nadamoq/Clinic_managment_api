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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->date('birth');
            $table->boolean('diabetes');
            $table->enum('gender',['male','female']);
            $table->enum('Blood_type',['A','B','O','AB']);
            $table->foreignId('procedure_id')->constrained('procedures')->cascadeOnDelete();
            $table->foreignId('receptionist_id')->constrained('receptionists')->nullOnDelete();
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
