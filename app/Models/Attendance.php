<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'recorded_by',
        'request_id',
        'att_date',
        'status',
        'check_in_time',
        'minutes_late',
        'note',
    ];

    protected $casts = [
        'att_date' => 'date',
        'minutes_late' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(AttendanceRequest::class, 'request_id');
    }
}

