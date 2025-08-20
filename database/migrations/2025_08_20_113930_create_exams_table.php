<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // Título del examen
            $table->string('title');
            // Breve descripción
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            // Número de preguntas que se mostrarán en cada intento (aleatorias)
            $table->integer('questions_per_attempt');
            // Duración máxima por intento en minutos
            $table->integer('duration_minutes')->nullable();
            // Fecha desde la que el examen está disponible
            $table->timestamp('available_from')->nullable();
            // Fecha hasta la que el examen está disponible
            $table->timestamp('available_until')->nullable();
            // Número máximo de intentos por usuario
            $table->integer('max_attempts')->default(1);
            // Puntaje mínimo requerido para aprobar
            $table->integer('min_score_to_pass')->nullable();
            // Indica si el examen está activo
            $table->boolean('is_active')->default(true);
            // barajar preguntas
            $table->boolean('shuffle_questions')->default(false);
            // mostrar resultados al terminar
            $table->boolean('show_results')->default(true);
            // permitir revisar respuestas
            $table->boolean('allow_review')->default(false);
            // mostrar cuáles eran correctas
            $table->boolean('show_correct_answers')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
