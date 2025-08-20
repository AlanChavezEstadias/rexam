<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamQuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $questions = $exam->questions()
            ->with('answers')
            ->orderBy('id', 'asc') // mostrar en orden de creación
            ->get();

        return view('admin.exams.questions.index', compact('exam', 'questions'));
    }

    public function create(Exam $exam)
    {
        return view('admin.exams.questions.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'questions'                  => 'required|array|min:1',
            'questions.*.text'           => 'required|string',
            'questions.*.type'           => 'required|in:true_false,multiple_choice',
            'questions.*.options'        => 'required|array|min:2',
            'questions.*.options.*.text' => 'required|string',
        ]);

        foreach ($request->questions as $q) {
            $question = $exam->questions()->create([
                'question_text' => $q['text'],
                'type'          => $q['type'],
                'score'         => 1,
            ]);

            foreach ($q['options'] as $opt) {
                $question->answers()->create([
                    'answer_text' => $opt['text'],
                    'is_correct'  => isset($opt['is_correct']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('admin.exams.questions.index', $exam)
            ->with('success', 'Preguntas creadas correctamente.');
    }

    public function edit(Exam $exam, Question $question)
    {
        return view('admin.exams.questions.edit', compact('exam', 'question'));
    }

    public function update(Request $request, Exam $exam, Question $question)
    {
        $request->validate([
            'text'           => 'required|string',
            'type'           => 'required|in:true_false,multiple_choice',
            'options'        => 'required|array|min:2',
            'options.*.text' => 'required|string',
        ]);

        $question->update([
            'question_text' => $request->text,
            'type'          => $request->type,
            'score'         => 1,
        ]);

        $question->answers()->delete();

        foreach ($request->options as $opt) {
            $question->answers()->create([
                'answer_text' => $opt['text'],
                'is_correct'  => isset($opt['is_correct']) ? 1 : 0,
            ]);
        }

        return redirect()->route('admin.exams.questions.index', $exam)
            ->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Exam $exam, Question $question)
    {
        $question->delete();

        return redirect()->route('admin.exams.questions.index', $exam)
            ->with('success', 'Pregunta eliminada correctamente.');
    }
}
