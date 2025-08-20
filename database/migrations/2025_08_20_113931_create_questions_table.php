<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->text('question_text');
            $table->enum('type', ['true_false', 'multiple_choice']);
            $table->integer('score')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
