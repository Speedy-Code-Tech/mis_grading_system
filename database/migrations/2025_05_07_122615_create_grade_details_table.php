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
        Schema::create('grade_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('score_index')->default(0);
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->string('criteria');
            $table->decimal('score', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_details');
    }
};
