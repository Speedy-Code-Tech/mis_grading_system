<?php

use App\Models\Section;
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
        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Section::class)->constrained()->onDelete('cascade');
            // $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_teacher_id')->constrained('subject_teachers')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            // $table->string('status')->default('Enrolled'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subjects');
    }
};
