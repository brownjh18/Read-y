<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['program.department', 'teachers'])->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::with('department')->get();
        return view('admin.courses.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:courses',
            'description' => 'nullable|string|max:1000',
            'program_id' => 'required|exists:programs,id',
            'credits' => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:8',
            'status' => 'required|in:active,inactive',
        ]);

        Course::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'program_id' => $request->program_id,
            'credits' => $request->credits,
            'semester' => $request->semester,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(['program.department', 'teachers', 'lectures', 'assignments']);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $programs = Program::with('department')->get();
        return view('admin.courses.edit', compact('course', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:10', Rule::unique('courses')->ignore($course->id)],
            'description' => 'nullable|string|max:1000',
            'program_id' => 'required|exists:programs,id',
            'credits' => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:8',
            'status' => 'required|in:active,inactive',
        ]);

        $course->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'program_id' => $request->program_id,
            'credits' => $request->credits,
            'semester' => $request->semester,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Check if course has lectures or assignments
        if ($course->lectures()->count() > 0 || $course->assignments()->count() > 0) {
            return redirect()->route('admin.courses.index')->with('error', 'Cannot delete course with associated lectures or assignments.');
        }

        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
