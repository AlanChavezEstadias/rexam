<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();
            // Examen al que corresponde el intento
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            // Usuario que presenta el examen
            $table->foreignId('exam_user_id')->constrained('exam_users')->onDelete('cascade');
            // Puntaje obtenido en este intento
            $table->integer('score')->nullable();
            // Si aprobó o no
            $table->boolean('is_passed')->default(false);
            // Inicio del intento
            $table->timestamp('started_at');
            // Fin del intento (o expiración por tiempo)
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};
