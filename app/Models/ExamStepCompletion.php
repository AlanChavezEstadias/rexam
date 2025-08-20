<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStepCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_step_id',
        'user_id',
        'is_completed',
    ];

    public function step()
    {
        return $this->belongsTo(ExamStep::class, 'exam_step_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
