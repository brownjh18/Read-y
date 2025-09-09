<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Courses Management
    public function courses()
    {
        $courses = Auth::user()->assignedCourses()->with('program.department')->paginate(10);
        return view('teacher.courses.index', compact('courses'));
    }

    public function showCourse(Course $course)
    {
        // Ensure the teacher is assigned to this course
        if (!$course->assignments()->where('teacher_id', Auth::id())->exists()) {
            abort(403, 'You are not assigned to this course.');
        }

        $course->load(['program.department', 'assignments', 'lectures']);
        return view('teacher.courses.show', compact('course'));
    }

    // Assignments Management
    public function assignments()
    {
        $assignments = Auth::user()->assignments()->with('course.program')->paginate(10);
        return view('teacher.assignments.index', compact('assignments'));
    }

    public function createAssignment()
    {
        $courses = Auth::user()->assignedCourses;
        return view('teacher.assignments.create', compact('courses'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'total_marks' => 'required|integer|min:1|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        // Ensure the teacher is assigned to the selected course
        if (!Auth::user()->assignedCourses()->where('courses.id', $request->course_id)->exists()) {
            return back()->withErrors(['course_id' => 'You are not assigned to this course.']);
        }

        $assignment = new Assignment();
        $assignment->course_id = $request->course_id;
        $assignment->teacher_id = Auth::id();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->total_marks = $request->total_marks;

        if ($request->hasFile('file')) {
            $assignment->file_path = $request->file('file')->store('assignments', 'public');
        }

        $assignment->save();

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function showAssignment(Assignment $assignment)
    {
        // Ensure the assignment belongs to the teacher
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only view your own assignments.');
        }

        $assignment->load(['course.program', 'submissions.student']);
        return view('teacher.assignments.show', compact('assignment'));
    }

    public function editAssignment(Assignment $assignment)
    {
        // Ensure the assignment belongs to the teacher
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only edit your own assignments.');
        }

        $courses = Auth::user()->assignedCourses;
        return view('teacher.assignments.edit', compact('assignment', 'courses'));
    }

    public function updateAssignment(Request $request, Assignment $assignment)
    {
        // Ensure the assignment belongs to the teacher
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only update your own assignments.');
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer|min:1|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        // Ensure the teacher is assigned to the selected course
        if (!Auth::user()->assignedCourses()->where('courses.id', $request->course_id)->exists()) {
            return back()->withErrors(['course_id' => 'You are not assigned to this course.']);
        }

        $assignment->course_id = $request->course_id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->total_marks = $request->total_marks;

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($assignment->file_path) {
                \Storage::disk('public')->delete($assignment->file_path);
            }
            $assignment->file_path = $request->file('file')->store('assignments', 'public');
        }

        $assignment->save();

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroyAssignment(Assignment $assignment)
    {
        // Ensure the assignment belongs to the teacher
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only delete your own assignments.');
        }

        // Check if assignment has submissions
        if ($assignment->submissions()->count() > 0) {
            return redirect()->route('teacher.assignments.index')->with('error', 'Cannot delete assignment with existing submissions.');
        }

        // Delete associated file if exists
        if ($assignment->file_path) {
            \Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment deleted successfully.');
    }

    // Submissions Management
    public function submissions()
    {
        $submissions = Submission::whereHas('assignment', function($query) {
            $query->where('teacher_id', Auth::id());
        })->with(['assignment.course', 'student'])->paginate(15);

        return view('teacher.submissions.index', compact('submissions'));
    }

    public function showSubmission(Submission $submission)
    {
        // Ensure the submission belongs to the teacher's assignment
        if ($submission->assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only view submissions for your assignments.');
        }

        $submission->load(['assignment.course', 'student']);
        return view('teacher.submissions.show', compact('submission'));
    }

    public function gradeSubmission(Request $request, Submission $submission)
    {
        // Ensure the submission belongs to the teacher's assignment
        if ($submission->assignment->teacher_id !== Auth::id()) {
            abort(403, 'You can only grade submissions for your assignments.');
        }

        $request->validate([
            'marks' => 'required|integer|min:0|max:' . $submission->assignment->total_marks,
            'feedback' => 'nullable|string|max:1000'
        ]);

        $submission->marks_obtained = $request->marks;
        $submission->feedback = $request->feedback;
        $submission->graded_at = now();
        $submission->status = 'graded';
        $submission->save();

        return redirect()->route('teacher.submissions.show', $submission)->with('success', 'Submission graded successfully.');
    }
}
