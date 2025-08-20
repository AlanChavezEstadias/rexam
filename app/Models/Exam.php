<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_by',
        'questions_per_attempt',
        'duration_minutes',
        'available_from',
        'available_until',
        'max_attempts',
        'min_score_to_pass',
        'is_active',
        'shuffle_questions',
        'show_results',
        'allow_review',
        'show_correct_answers',
    ];

    // Relaciones
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function steps()
    {
        return $this->hasMany(ExamStep::class);
    }

}
