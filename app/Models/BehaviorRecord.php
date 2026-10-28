<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BehaviorRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'category_id',
        'type',
        'points',
        'demerit_point_balance_after',
        'incident_date',
        'title',
        'notes',
        'evidence_url',
        'action_taken',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'points' => 'integer',
        'demerit_point_balance_after' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BehaviorCategory::class, 'category_id');
    }
}

