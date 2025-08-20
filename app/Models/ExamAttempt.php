<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'exam_user_id',
        'score',
        'is_passed',
        'started_at',
        'finished_at',
    ];

    // Relaciones
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(ExamUser::class, 'exam_user_id');
    }

    public function answers()
    {
        return $this->hasMany(ExamAttemptAnswer::class);
    }
}
