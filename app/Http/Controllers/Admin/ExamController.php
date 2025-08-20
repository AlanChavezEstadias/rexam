<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string',
            'questions_per_attempt' => 'required|integer|min:1',
            'duration_minutes'      => 'nullable|integer|min:1',
            'available_from'        => 'nullable|date',
            'available_until'       => 'nullable|date|after_or_equal:available_from',
            'max_attempts'          => 'required|integer|min:1',
            'min_score_to_pass'     => 'nullable|integer|min:0',
        ]);

        $validated['created_by'] = auth()->id();

        $exam = Exam::create($validated);

        // Redirigir a configuración (Paso 2) en lugar de index
        return redirect()->route('admin.exams.setup', $exam)
            ->with('success', 'Examen creado, ahora configúralo.');
    }

    public function show(Exam $exam)
    {
        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        return view('admin.exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string',
            'questions_per_attempt' => 'required|integer|min:1',
            'duration_minutes'      => 'nullable|integer|min:1',
            'available_from'        => 'nullable|date',
            'available_until'       => 'nullable|date|after_or_equal:available_from',
            'max_attempts'          => 'required|integer|min:1',
            'min_score_to_pass'     => 'nullable|integer|min:0',
        ]);

        $exam->update($validated);

        return redirect()->route('admin.exams.index')
            ->with('success', 'Examen actualizado correctamente.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('admin.exams.index')
            ->with('success', 'Examen eliminado correctamente.');
    }

    /**
     * Paso 2: Mostrar configuración previa
     */
    public function setup(Exam $exam)
    {
        return view('admin.exams.setup', compact('exam'));
    }

    // Paso 2: Guardar configuración
    public function setupStore(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'shuffle_questions'    => 'nullable|boolean',
            'show_results'         => 'nullable|boolean',
            'allow_review'         => 'nullable|boolean',
            'show_correct_answers' => 'nullable|boolean',
        ]);

        $exam->update([
            'shuffle_questions'    => $request->has('shuffle_questions'),
            'show_results'         => $request->has('show_results'),
            'allow_review'         => $request->has('allow_review'),
            'show_correct_answers' => $request->has('show_correct_answers'),
        ]);

        // Ahora lo mandamos a Paso 3 (Preguntas)
        return redirect()->route('admin.exams.questions.index', $exam)
            ->with('success', 'Configuración guardada, ahora agrega preguntas.');
    }

}
