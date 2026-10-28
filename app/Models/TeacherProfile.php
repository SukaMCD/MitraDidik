<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'bio',
        'photo_url',
        'teaching_style',
        'consult_hours',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

