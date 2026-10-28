<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentBehaviorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'initial_demerit_points',
        'current_demerit_points',
        'total_merit_points',
        'warning_level',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public static function calculateWarningLevel(int $currentDemerit): string
    {
        if ($currentDemerit >= 85) {
            return 'normal';
        } elseif ($currentDemerit >= 70) {
            return 'sp1';
        } elseif ($currentDemerit >= 50) {
            return 'sp2';
        }
        return 'sp3';
    }

    public function deductDemerit(int $points): void
    {
        $this->current_demerit_points = max(0, $this->current_demerit_points - $points);
        $this->warning_level = self::calculateWarningLevel($this->current_demerit_points);
        $this->save();
    }

    public function addMerit(int $points): void
    {
        $this->total_merit_points += $points;
        $this->save();
    }
}

