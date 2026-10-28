<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npsn',
        'address',
        'phone',
        'logo_url',
        'quiet_start',
        'quiet_end',
        'timezone',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function academicYears(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function isCurrentlyQuietHours(): bool
    {
        $tz = $this->timezone ?: 'Asia/Jakarta';
        $now = Carbon::now($tz);
        $timeStr = $now->format('H:i:s');

        // Contoh: quiet_start: 17:00:00, quiet_end: 07:00:00
        if ($this->quiet_start > $this->quiet_end) {
            // Melewati tengah malam
            return $timeStr >= $this->quiet_start || $timeStr < $this->quiet_end;
        }

        return $timeStr >= $this->quiet_start && $timeStr < $this->quiet_end;
    }

    public function nextQuietEnd(): Carbon
    {
        $tz = $this->timezone ?: 'Asia/Jakarta';
        $now = Carbon::now($tz);
        $quietEndToday = Carbon::parse($this->quiet_end, $tz);

        if ($now->greaterThanOrEqualTo($quietEndToday)) {
            return $quietEndToday->addDay();
        }

        return $quietEndToday;
    }
}

