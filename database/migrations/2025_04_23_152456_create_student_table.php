<?php

use App\Models\Department;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_id')->unique(); 
            $table->string('type');
            $table->string('level');
            $table->foreignIdFor(Department::class)->constrained()->onDelete('cascade');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('gender');
            $table->string('bdate');
            $table->string('contact');
            $table->string('street');
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->string('brgy');
            $table->foreignIdFor(Section::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
