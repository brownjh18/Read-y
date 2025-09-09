<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isTeacher()) {
        return redirect()->route('teacher.dashboard');
    } elseif ($user->isStudent()) {
        return redirect()->route('student.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);

    // Academic Management
    Route::resource('departments', \App\Http\Controllers\DepartmentController::class);
    Route::resource('programs', \App\Http\Controllers\ProgramController::class);
    Route::resource('courses', \App\Http\Controllers\CourseController::class);

    // Course Assignments
    Route::get('/course-assignments', [\App\Http\Controllers\AdminController::class, 'courseAssignments'])->name('course-assignments.index');
    Route::post('/course-assignments', [\App\Http\Controllers\AdminController::class, 'assignTeacher'])->name('course-assignments.store');
    Route::delete('/course-assignments/{assignment}', [\App\Http\Controllers\AdminController::class, 'removeAssignment'])->name('course-assignments.destroy');

    // Reports
    Route::get('/reports/users', function () {
        $users = \App\Models\User::with('role')->paginate(20);
        return view('admin.reports.users', compact('users'));
    })->name('reports.users');

    Route::get('/reports/academic', function () {
        $departments = \App\Models\Department::with('programs.courses')->get();
        return view('admin.reports.academic', compact('departments'));
    })->name('reports.academic');

    // Settings
    Route::get('/settings/general', function () {
        return view('admin.settings.general');
    })->name('settings.general');

    Route::get('/settings/email', function () {
        return view('admin.settings.email');
    })->name('settings.email');

    // Dashboard
    Route::get('/dashboard', function () {
        $userCount = \App\Models\User::count();
        $roleCount = \App\Models\Role::count();
        $departmentCount = \App\Models\Department::count();
        $courseCount = \App\Models\Course::count();

        return view('admin.dashboard', compact('userCount', 'roleCount', 'departmentCount', 'courseCount'));
    })->name('dashboard');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('teacher.dashboard');
    })->name('dashboard');

    // Courses Management
    Route::get('/courses', [\App\Http\Controllers\TeacherController::class, 'courses'])->name('courses.index');
    Route::get('/courses/{course}', [\App\Http\Controllers\TeacherController::class, 'showCourse'])->name('courses.show');

    // Assignments Management
    Route::get('/assignments/create', [\App\Http\Controllers\TeacherController::class, 'createAssignment'])->name('assignments.create');
    Route::post('/assignments', [\App\Http\Controllers\TeacherController::class, 'storeAssignment'])->name('assignments.store');
    Route::get('/assignments', [\App\Http\Controllers\TeacherController::class, 'assignments'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [\App\Http\Controllers\TeacherController::class, 'showAssignment'])->name('assignments.show');
    Route::get('/assignments/{assignment}/edit', [\App\Http\Controllers\TeacherController::class, 'editAssignment'])->name('assignments.edit');
    Route::put('/assignments/{assignment}', [\App\Http\Controllers\TeacherController::class, 'updateAssignment'])->name('assignments.update');
    Route::delete('/assignments/{assignment}', [\App\Http\Controllers\TeacherController::class, 'destroyAssignment'])->name('assignments.destroy');

    // Submissions Management
    Route::get('/submissions', [\App\Http\Controllers\TeacherController::class, 'submissions'])->name('submissions.index');
    Route::get('/submissions/{submission}', [\App\Http\Controllers\TeacherController::class, 'showSubmission'])->name('submissions.show');
    Route::post('/submissions/{submission}/grade', [\App\Http\Controllers\TeacherController::class, 'gradeSubmission'])->name('submissions.grade');
});

// Teacher routes are already defined above

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('dashboard');

    // Courses Management
    Route::get('/courses', [\App\Http\Controllers\StudentController::class, 'courses'])->name('courses.index');
    Route::get('/courses/{course}', [\App\Http\Controllers\StudentController::class, 'showCourse'])->name('courses.show');

    // Assignments Management
    Route::get('/assignments', [\App\Http\Controllers\StudentController::class, 'assignments'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [\App\Http\Controllers\StudentController::class, 'showAssignment'])->name('assignments.show');
    Route::get('/assignments/{assignment}/submit', [\App\Http\Controllers\StudentController::class, 'submitAssignment'])->name('assignments.submit');
    Route::post('/assignments/{assignment}/submit', [\App\Http\Controllers\StudentController::class, 'storeSubmission'])->name('assignments.storeSubmission');

    // Grades Management
    Route::get('/grades', [\App\Http\Controllers\StudentController::class, 'grades'])->name('grades.index');

    // Profile Management
    Route::get('/profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\StudentController::class, 'updateProfile'])->name('profile.update');
});

require __DIR__.'/auth.php';
