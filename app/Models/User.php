<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'student_id',
        'employee_id',
        'phone',
        'date_of_birth',
        'gender',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isTeacher()
    {
        return $this->role && $this->role->name === 'teacher';
    }

    public function isStudent()
    {
        return $this->role && $this->role->name === 'student';
    }

    // Student-specific relationships
    public function getEnrolledCoursesAttribute()
    {
        // Return courses that have assignments accessible to students
        return Course::whereHas('assignments', function($query) {
            $query->where('teacher_id', '!=', $this->id); // Exclude courses where user is teacher
        })->with(['program.department', 'assignments'])->get();
    }

    public function getPendingAssignmentsAttribute()
    {
        return Assignment::whereDoesntHave('submissions', function($query) {
                        $query->where('student_id', $this->id);
                    })
                    ->where('due_date', '>', now())
                    ->with(['course'])
                    ->orderBy('due_date', 'asc')
                    ->get();
    }

    public function getSubmittedAssignmentsAttribute()
    {
        return $this->hasMany(Submission::class, 'student_id')->get();
    }

    public function getAverageGradeAttribute()
    {
        $grades = $this->submittedAssignments->whereNotNull('marks');
        if ($grades->isEmpty()) {
            return null;
        }

        $totalWeightedScore = 0;
        $totalWeight = 0;

        foreach ($grades as $grade) {
            $weight = $grade->assignment->total_marks;
            $totalWeightedScore += ($grade->marks / $grade->assignment->total_marks) * 100 * $weight;
            $totalWeight += $weight;
        }

        return $totalWeight > 0 ? $totalWeightedScore / $totalWeight : null;
    }

    public function getRecentGradesAttribute()
    {
        return $this->hasMany(Submission::class, 'student_id')
                    ->whereNotNull('marks')
                    ->with(['assignment.course'])
                    ->orderBy('graded_at', 'desc')
                    ->take(10)
                    ->get();
    }

    // Relationships for teachers
    public function assignedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_assignments', 'teacher_id', 'course_id')
                    ->withPivot('academic_year', 'semester', 'status')
                    ->withTimestamps();
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'teacher_id');
    }

    // Relationships for students
    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
                    ->withPivot('enrolled_at', 'status')
                    ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }
}
