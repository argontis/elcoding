<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramKursus;
use App\Models\ProgramModule;
use App\Models\ProgramModuleQuestion;
use Illuminate\Support\Facades\Storage;

class ProgramModuleController extends Controller
{
    public function index($program_id)
    {
        $program = ProgramKursus::findOrFail($program_id);
        $modules = ProgramModule::where('program_id', $program_id)->orderBy('order_index')->get();
        return view('admin.program-module.index', compact('program', 'modules'));
    }

    public function create($program_id)
    {
        $program = ProgramKursus::findOrFail($program_id);
        return view('admin.program-module.form', compact('program'));
    }

    public function store(Request $request, $program_id)
    {
        $program = ProgramKursus::findOrFail($program_id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:materi,video,quiz,tugas,project',
            'order_index' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'description', 'type', 'content', 'video_url', 'order_index']);
        $data['program_id'] = $program_id;

        if (!$request->order_index) {
            $data['order_index'] = ProgramModule::where('program_id', $program_id)->max('order_index') + 1;
        }

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/modules', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
        }

        ProgramModule::create($data);

        return redirect()->route('admin.program.modules.index', $program_id)->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit($program_id, $id)
    {
        $program = ProgramKursus::findOrFail($program_id);
        $module = ProgramModule::findOrFail($id);
        return view('admin.program-module.form', compact('program', 'module'));
    }

    public function update(Request $request, $program_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:materi,video,quiz,tugas,project',
            'order_index' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'description', 'type', 'content', 'video_url', 'order_index']);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/modules', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
        }

        $module->update($data);

        return redirect()->route('admin.program.modules.index', $program_id)->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy($program_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        $module->delete();
        return redirect()->route('admin.program.modules.index', $program_id)->with('success', 'Modul berhasil dihapus.');
    }

    public function quizBuilder($program_id, $id)
    {
        $program = ProgramKursus::findOrFail($program_id);
        $module = ProgramModule::with('questions')->findOrFail($id);
        
        if ($module->type !== 'quiz') {
            return redirect()->route('admin.program.modules.index', $program_id)->with('error', 'Modul ini bukan berupa Quiz.');
        }

        return view('admin.program-module.quiz-builder', compact('program', 'module'));
    }

    public function storeQuestion(Request $request, $program_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:multiple_choice,essay',
            'question_text' => 'required|string',
            'score_weight' => 'required|integer|min:1',
        ]);

        $data = [
            'program_module_id' => $module->id,
            'type' => $request->type,
            'question_text' => $request->question_text,
            'score_weight' => $request->score_weight,
        ];

        if ($request->type === 'multiple_choice') {
            $options = [];
            if ($request->has('option_A')) $options['A'] = $request->option_A;
            if ($request->has('option_B')) $options['B'] = $request->option_B;
            if ($request->has('option_C')) $options['C'] = $request->option_C;
            if ($request->has('option_D')) $options['D'] = $request->option_D;
            if ($request->has('option_E')) $options['E'] = $request->option_E;
            
            $data['options'] = $options;
            $data['correct_answer'] = $request->correct_answer;
        }

        ProgramModuleQuestion::create($data);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }

    public function destroyQuestion($program_id, $module_id, $question_id)
    {
        $question = ProgramModuleQuestion::findOrFail($question_id);
        $question->delete();
        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }

    // ==========================================
    // EVENT MODULES METHODS
    // ==========================================

    public function indexEvent($event_id)
    {
        $event = \App\Models\Event::findOrFail($event_id);
        $modules = ProgramModule::where('event_id', $event_id)->orderBy('order_index')->get();
        return view('admin.program-module.index', compact('event', 'modules'));
    }

    public function createEvent($event_id)
    {
        $event = \App\Models\Event::findOrFail($event_id);
        return view('admin.program-module.form', compact('event'));
    }

    public function storeEvent(Request $request, $event_id)
    {
        $event = \App\Models\Event::findOrFail($event_id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:materi,video,quiz,tugas,project',
            'order_index' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'description', 'type', 'content', 'video_url', 'order_index']);
        $data['event_id'] = $event_id;

        if (!$request->order_index) {
            $data['order_index'] = ProgramModule::where('event_id', $event_id)->max('order_index') + 1;
        }

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/modules', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
        }

        ProgramModule::create($data);

        return redirect()->route('admin.event.modules.index', $event_id)->with('success', 'Modul Event berhasil ditambahkan.');
    }

    public function editEvent($event_id, $id)
    {
        $event = \App\Models\Event::findOrFail($event_id);
        $module = ProgramModule::findOrFail($id);
        return view('admin.program-module.form', compact('event', 'module'));
    }

    public function updateEvent(Request $request, $event_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:materi,video,quiz,tugas,project',
            'order_index' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'description', 'type', 'content', 'video_url', 'order_index']);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/modules', $filename, 'public');
            $data['file_path'] = 'storage/' . $path;
        }

        $module->update($data);

        return redirect()->route('admin.event.modules.index', $event_id)->with('success', 'Modul Event berhasil diperbarui.');
    }

    public function destroyEvent($event_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        $module->delete();
        return redirect()->route('admin.event.modules.index', $event_id)->with('success', 'Modul Event berhasil dihapus.');
    }

    public function quizBuilderEvent($event_id, $id)
    {
        $event = \App\Models\Event::findOrFail($event_id);
        $module = ProgramModule::with('questions')->findOrFail($id);
        
        if ($module->type !== 'quiz') {
            return redirect()->route('admin.event.modules.index', $event_id)->with('error', 'Modul ini bukan berupa Quiz.');
        }

        return view('admin.program-module.quiz-builder', compact('event', 'module'));
    }

    public function storeQuestionEvent(Request $request, $event_id, $id)
    {
        $module = ProgramModule::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:multiple_choice,essay',
            'question_text' => 'required|string',
            'score_weight' => 'required|integer|min:1',
        ]);

        $data = [
            'program_module_id' => $module->id,
            'type' => $request->type,
            'question_text' => $request->question_text,
            'score_weight' => $request->score_weight,
        ];

        if ($request->type === 'multiple_choice') {
            $options = [];
            if ($request->has('option_A')) $options['A'] = $request->option_A;
            if ($request->has('option_B')) $options['B'] = $request->option_B;
            if ($request->has('option_C')) $options['C'] = $request->option_C;
            if ($request->has('option_D')) $options['D'] = $request->option_D;
            if ($request->has('option_E')) $options['E'] = $request->option_E;
            
            $data['options'] = $options;
            $data['correct_answer'] = $request->correct_answer;
        }

        ProgramModuleQuestion::create($data);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }

    public function destroyQuestionEvent($event_id, $module_id, $question_id)
    {
        $question = ProgramModuleQuestion::findOrFail($question_id);
        $question->delete();
        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }
}
