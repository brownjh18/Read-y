<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'program_id',
        'credits',
        'semester',
        'status',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_assignments', 'course_id', 'teacher_id')
                    ->withPivot('academic_year', 'semester', 'status')
                    ->withTimestamps();
    }

    public function courseAssignments()
    {
        return $this->hasMany(CourseAssignment::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }
}
