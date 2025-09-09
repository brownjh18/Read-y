<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_text',
        'file_path',
        'submitted_at',
        'marks_obtained',
        'feedback',
        'graded_at',
        'status',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Accessor for marks compatibility
    public function getMarksAttribute()
    {
        return $this->marks_obtained;
    }

    public function setMarksAttribute($value)
    {
        $this->attributes['marks_obtained'] = $value;
    }

    // Accessor for content compatibility
    public function getContentAttribute()
    {
        return $this->submission_text;
    }

    public function setContentAttribute($value)
    {
        $this->attributes['submission_text'] = $value;
    }

    // Helper methods
    public function isLate()
    {
        return $this->assignment && $this->submitted_at > $this->assignment->due_date;
    }

    public function getPercentageAttribute()
    {
        if (!$this->assignment || !$this->marks_obtained) {
            return 0;
        }
        return round(($this->marks_obtained / $this->assignment->total_marks) * 100, 1);
    }

    public function getGradeAttribute()
    {
        $percentage = $this->percentage;

        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 60) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }
}
