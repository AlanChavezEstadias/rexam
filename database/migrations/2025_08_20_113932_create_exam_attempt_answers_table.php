<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempt_answers', function (Blueprint $table) {
            $table->id();
            // Intento al que pertenece la respuesta
            $table->foreignId('exam_attempt_id')->constrained('exam_attempts')->onDelete('cascade');
            // Pregunta que fue respondida
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            // Respuesta seleccionada (nullable para preguntas abiertas)
            $table->foreignId('answer_id')->nullable()->constrained('answers')->onDelete('set null');
            // Indica si la respuesta fue correcta
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_answers');
    }
};
