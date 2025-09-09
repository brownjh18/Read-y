<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseAssignment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function courseAssignments()
    {
        $assignments = CourseAssignment::with(['course.program.department', 'teacher'])->paginate(15);
        $courses = Course::with('program.department')->get();
        $teachers = User::whereHas('role', function($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('admin.course-assignments.index', compact('assignments', 'courses', 'teachers'));
    }

    public function assignTeacher(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
            'academic_year' => 'required|string',
            'semester' => 'required|integer|min:1|max:2',
        ]);

        // Check if teacher is already assigned to this course for the same academic year and semester
        $existing = CourseAssignment::where('course_id', $request->course_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('academic_year', $request->academic_year)
            ->where('semester', $request->semester)
            ->first();

        if ($existing) {
            return back()->withErrors(['assignment' => 'This teacher is already assigned to this course for the selected academic year and semester.']);
        }

        CourseAssignment::create([
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'status' => 'active',
        ]);

        return back()->with('success', 'Teacher assigned to course successfully.');
    }

    public function removeAssignment(CourseAssignment $assignment)
    {
        $assignment->delete();
        return back()->with('success', 'Course assignment removed successfully.');
    }
}
