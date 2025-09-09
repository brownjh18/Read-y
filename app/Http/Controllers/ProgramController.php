<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with(['department', 'courses'])->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.programs.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:programs',
            'description' => 'nullable|string|max:1000',
            'department_id' => 'required|exists:departments,id',
            'duration_years' => 'required|integer|min:1|max:10',
            'level' => 'required|in:undergraduate,postgraduate,diploma,certificate',
        ]);

        Program::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'duration_years' => $request->duration_years,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $program->load(['department', 'courses']);
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $departments = Department::all();
        return view('admin.programs.edit', compact('program', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:10', Rule::unique('programs')->ignore($program->id)],
            'description' => 'nullable|string|max:1000',
            'department_id' => 'required|exists:departments,id',
            'duration_years' => 'required|integer|min:1|max:10',
            'level' => 'required|in:undergraduate,postgraduate,diploma,certificate',
        ]);

        $program->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'duration_years' => $request->duration_years,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // Check if program has courses
        if ($program->courses()->count() > 0) {
            return redirect()->route('admin.programs.index')->with('error', 'Cannot delete program with associated courses.');
        }

        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }
}
