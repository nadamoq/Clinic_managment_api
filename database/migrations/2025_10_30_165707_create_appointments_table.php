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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); 
            $table->date('date');                 
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status',['pending','processing','completed','canceled'])->default('pending');            
            $table->boolean('evaluated')->default(false);
            $table->foreignId('supervisor_id')->constrained('supervisors')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');         
            //لازم نعمل رووم اي دي فورين كييييي     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
