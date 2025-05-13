<?php

use App\Models\Quarter;
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
        Schema::create('subject_teachers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Section::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Quarter::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teachers');
    }
};
