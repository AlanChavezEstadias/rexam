<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamStep;
use Illuminate\Http\Request;

class ExamPreviewController extends Controller
{
    public function index(Exam $exam)
    {
        $steps = $exam->steps()->orderBy('order', 'asc')->get();
        return view('admin.exams.preview', compact('exam', 'steps'));
    }

    public function completeStep(Request $request, Exam $exam, ExamStep $step)
    {
        $request->user()->examSteps()->syncWithoutDetaching([$step->id]);
        return response()->json(['success' => true]);
    }
}
