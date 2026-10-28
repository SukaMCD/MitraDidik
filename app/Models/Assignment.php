<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'course_mapping_id',
        'gclass_coursework_id',
        'title',
        'description',
        'due_date',
        'max_points',
        'alternate_link',
        'source',
        'sync_status',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'max_points' => 'decimal:2',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function getDueDiffForHumansAttribute(): string
    {
        if (!$this->due_date) {
            return 'Tanpa tenggat';
        }

        $now = Carbon::now();
        if ($this->due_date->isToday()) {
            return 'Hari ini, ' . $this->due_date->format('H:i');
        } elseif ($this->due_date->isTomorrow()) {
            return 'Besok, ' . $this->due_date->format('H:i');
        } elseif ($this->due_date->isPast()) {
            return 'Telah lewat (' . $this->due_date->translatedFormat('d M H:i') . ')';
        }

        return $this->due_date->diffForHumans();
    }
}

