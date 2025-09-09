<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Courses Management
    public function courses()
    {
        $courses = Course::whereHas('assignments', function($query) {
            $query->where('teacher_id', '!=', auth()->id());
        })->with('program.department')->paginate(10);
        return view('student.courses.index', compact('courses'));
    }

    public function showCourse(Course $course)
    {
        $course->load(['program.department', 'assignments.submissions' => function($query) {
            $query->where('student_id', Auth::id());
        }]);

        // Filter assignments to only show those accessible to this student
        $assignments = $course->assignments->filter(function($assignment) {
            return $assignment->teacher_id !== Auth::id(); // Exclude if student is also a teacher of this course
        });

        return view('student.courses.show', compact('course', 'assignments'));
    }

    // Assignments Management
    public function assignments()
    {
        $assignments = Assignment::whereDoesntHave('submissions', function($query) {
            $query->where('student_id', Auth::id());
        })
        ->with(['course.program'])
        ->orderBy('due_date', 'asc')
        ->paginate(12);

        return view('student.assignments.index', compact('assignments'));
    }

    public function showAssignment(Assignment $assignment)
    {
        // Load assignment with related data
        $assignment->load(['course.program', 'teacher', 'submissions' => function($query) {
            $query->where('student_id', Auth::id());
        }]);

        $submission = $assignment->submissions->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submitAssignment(Assignment $assignment)
    {
        // Check if student has already submitted
        $existingSubmission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existingSubmission) {
            return redirect()->route('student.assignments.show', $assignment)
                ->with('error', 'You have already submitted this assignment.');
        }

        // Check if assignment is still active
        if ($assignment->due_date && $assignment->due_date < now()) {
            return redirect()->route('student.assignments.show', $assignment)
                ->with('error', 'This assignment is past its due date.');
        }

        return view('student.assignments.submit', compact('assignment'));
    }

    public function storeSubmission(Request $request, Assignment $assignment)
    {
        $request->validate([
            'comments' => 'nullable|string|max:1000',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,zip|max:10240'
        ]);

        // Check if student has already submitted
        $existingSubmission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existingSubmission) {
            return redirect()->route('student.assignments.show', $assignment)
                ->with('error', 'You have already submitted this assignment.');
        }

        $submission = new Submission();
        $submission->assignment_id = $assignment->id;
        $submission->student_id = Auth::id();
        $submission->submission_text = $request->comments;
        $submission->submitted_at = now();
        $submission->status = 'submitted';

        if ($request->hasFile('file')) {
            $submission->file_path = $request->file('file')->store('submissions', 'public');
        }

        $submission->save();

        return redirect()->route('student.assignments.show', $assignment)
            ->with('success', 'Assignment submitted successfully.');
    }

    // Grades Management
    public function grades()
    {
        $submissions = Submission::where('student_id', Auth::id())
            ->whereNotNull('marks')
            ->with(['assignment.course.program'])
            ->orderBy('graded_at', 'desc')
            ->paginate(15);

        $averageGrade = Auth::user()->averageGrade;

        return view('student.grades.index', compact('submissions', 'averageGrade'));
    }

    // Profile Management
    public function profile()
    {
        $user = Auth::user();
        return view('student.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->update($request->only([
            'name', 'email', 'phone', 'date_of_birth', 'gender', 'address'
        ]));

        return redirect()->route('student.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
