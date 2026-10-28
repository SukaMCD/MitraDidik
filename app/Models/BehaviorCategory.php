<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BehaviorCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'type',
        'name',
        'points',
        'severity_level',
        'description',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function records(): HasMany
    {
        return $this->hasMany(BehaviorRecord::class, 'category_id');
    }
}

