<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamStep;
use Illuminate\Http\Request;

class ExamStepController extends Controller
{
    public function index(Exam $exam)
    {
        $steps = $exam->steps()->orderBy('order', 'asc')->get();

        return view('admin.exams.steps.index', compact('exam', 'steps'));
    }

    public function create(Exam $exam)
    {
        return view('admin.exams.steps.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:text,document,video,video_url,image,audio,link',
            'content'     => 'nullable|string',
            'content_url' => 'nullable|url',
            'file'        => 'nullable|file|max:10240', // hasta 10MB
            'order'       => 'nullable|integer|min:1',
        ]);

        $data = [
            'exam_id'     => $exam->id,
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type'        => $validated['type'],
            'order'       => $validated['order'] ?? $exam->steps()->count() + 1,
        ];

        // Guardar según tipo
        if ($validated['type'] === 'text') {
            $data['content'] = $validated['content'];
        } elseif (in_array($validated['type'], ['video_url', 'link'])) {
            $data['content'] = $validated['content_url'];
        } elseif ($request->hasFile('file')) {
            // 📂 esto guarda el archivo en storage/app/public/steps
            $path            = $request->file('file')->store('steps', 'public');
            $data['content'] = $path;
        }

        ExamStep::create($data);

        return redirect()->route('admin.exams.steps.index', $exam)
            ->with('success', 'Paso creado correctamente.');
    }

    public function edit(Exam $exam, ExamStep $step)
    {
        return view('admin.exams.steps.edit', compact('exam', 'step'));
    }

    public function update(Request $request, Exam $exam, ExamStep $step)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:text,document,video,video_url,image,audio,link',
            'content'     => 'nullable|string',
            'content_url' => 'nullable|url',
            'file'        => 'nullable|file|max:10240',
            'order'       => 'nullable|integer|min:1',
        ]);

        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type'        => $validated['type'],
            'order'       => $validated['order'] ?? $step->order,
        ];

        if ($validated['type'] === 'text') {
            $data['content'] = $validated['content'];
        } elseif (in_array($validated['type'], ['video_url', 'link'])) {
            $data['content'] = $validated['content_url'];
        } elseif ($request->hasFile('file')) {
            $path            = $request->file('file')->store('steps', 'public');
            $data['content'] = $path;
        }

        $step->update($data);

        return redirect()->route('admin.exams.steps.index', $exam)
            ->with('success', 'Paso actualizado correctamente.');
    }

    public function destroy(Exam $exam, ExamStep $step)
    {
        $step->delete();

        return redirect()->route('admin.exams.steps.index', $exam)
            ->with('success', 'Paso eliminado correctamente.');
    }
}
