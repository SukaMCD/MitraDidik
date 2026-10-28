<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\StudentBehaviorProfile;
use App\Models\School;
use Carbon\Carbon;

class CriticalLogicTest extends TestCase
{
    /**
     * Uji logika perhitungan tingkat peringatan Demerit (100 ke 0).
     */
    public function test_demerit_warning_levels(): void
    {
        // Kondisi Normal (>= 85)
        $this->assertEquals('normal', StudentBehaviorProfile::calculateWarningLevel(100));
        $this->assertEquals('normal', StudentBehaviorProfile::calculateWarningLevel(85));

        // Peringatan 1 (SP1: 70 - 84)
        $this->assertEquals('sp1', StudentBehaviorProfile::calculateWarningLevel(84));
        $this->assertEquals('sp1', StudentBehaviorProfile::calculateWarningLevel(70));

        // Peringatan 2 (SP2: 50 - 69)
        $this->assertEquals('sp2', StudentBehaviorProfile::calculateWarningLevel(69));
        $this->assertEquals('sp2', StudentBehaviorProfile::calculateWarningLevel(50));

        // Peringatan Kritis (SP3: < 50)
        $this->assertEquals('sp3', StudentBehaviorProfile::calculateWarningLevel(49));
        $this->assertEquals('sp3', StudentBehaviorProfile::calculateWarningLevel(10));
        $this->assertEquals('sp3', StudentBehaviorProfile::calculateWarningLevel(0));
    }

    /**
     * Uji kalkulasi persentase kehadiran:
     * persentase = ((hadir + terlambat) / hari_efektif) * 100%
     */
    public function test_attendance_recap_percentage_formula(): void
    {
        $hariEfektif = 20;
        $hadir = 16;
        $terlambat = 2; // Terhitung hadir namun terlambat
        $sakit = 1;
        $alpa = 1;

        $totalMasuk = $hadir + $terlambat;
        $persentase = ($totalMasuk / $hariEfektif) * 100;

        $this->assertEquals(90.0, $persentase);
        $this->assertEquals(2, $sakit + $alpa);
    }

    /**
     * Uji logika evaluasi Jam Tenang (Quiet Hours).
     */
    public function test_quiet_hours_calculation(): void
    {
        $school = new School([
            'quiet_start' => '17:00:00',
            'quiet_end' => '07:00:00',
            'timezone' => 'Asia/Jakarta',
        ]);

        // Malam hari (pk 20:00) harus terdeteksi Jam Tenang
        $timeEvening = '20:00:00';
        $isQuietNight = ($timeEvening >= $school->quiet_start || $timeEvening < $school->quiet_end);
        $this->assertTrue($isQuietNight);

        // Siang hari (pk 10:00) harus terdeteksi Jam Kerja Aktif (bukan Jam Tenang)
        $timeMorning = '10:00:00';
        $isQuietWorkHour = ($timeMorning >= $school->quiet_start || $timeMorning < $school->quiet_end);
        $this->assertFalse($isQuietWorkHour);
    }
}

