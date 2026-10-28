<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\School;
use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\ClassTeacher;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\StudentBehaviorProfile;
use App\Models\BehaviorCategory;
use App\Models\BehaviorRecord;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\ChatRoom;
use App\Models\ChatMessage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $passwordHash = Hash::make('password123');

        // 1. Buat Sekolah
        $school = School::create([
            'name' => 'SMP Budi Luhur Jakarta',
            'npsn' => '20109988',
            'address' => 'Jl. Pendidikan No. 45, Jakarta Selatan',
            'phone' => '021-7890123',
            'logo_url' => '/brand/logo-icon.svg',
            'quiet_start' => '17:00:00',
            'quiet_end' => '07:00:00',
            'timezone' => 'Asia/Jakarta',
        ]);

        // 2. Buat Admin Sekolah
        $admin = User::create([
            'school_id' => $school->id,
            'name' => 'Hendra Wijaya, S.Kom (Admin)',
            'email' => 'admin@mitradidik.sch.id',
            'password' => $passwordHash,
            'role' => 'admin',
            'phone' => '081234567890',
            'is_active' => true,
        ]);

        // 3. Buat Tahun Ajaran
        $academicYear = AcademicYear::create([
            'school_id' => $school->id,
            'name' => '2026/2027 Ganjil',
            'start_date' => '2026-07-15',
            'end_date' => '2026-12-20',
            'is_active' => true,
        ]);

        // 4. Buat Rombongan Belajar (Kelas)
        $class7A = SchoolClass::create([
            'school_id' => $school->id,
            'academic_year_id' => $academicYear->id,
            'name' => 'Kelas 7A',
            'grade_level' => 7,
        ]);

        $class7B = SchoolClass::create([
            'school_id' => $school->id,
            'academic_year_id' => $academicYear->id,
            'name' => 'Kelas 7B',
            'grade_level' => 7,
        ]);

        // 5. Buat Mata Pelajaran
        $subMatematika = Subject::create([
            'school_id' => $school->id,
            'name' => 'Matematika',
            'code' => 'MAT-7',
            'banner_color' => '#1A73E8',
        ]);

        $subIPA = Subject::create([
            'school_id' => $school->id,
            'name' => 'Ilmu Pengetahuan Alam',
            'code' => 'IPA-7',
            'banner_color' => '#188038',
        ]);

        $subBIndo = Subject::create([
            'school_id' => $school->id,
            'name' => 'Bahasa Indonesia',
            'code' => 'BIN-7',
            'banner_color' => '#C5221F',
        ]);

        $subBInggris = Subject::create([
            'school_id' => $school->id,
            'name' => 'Bahasa Inggris',
            'code' => 'BIG-7',
            'banner_color' => '#8430CE',
        ]);

        $subIPS = Subject::create([
            'school_id' => $school->id,
            'name' => 'Ilmu Pengetahuan Sosial',
            'code' => 'IPS-7',
            'banner_color' => '#C26401',
        ]);

        // 6. Buat 5 Guru
        $teachersData = [
            [
                'name' => 'Ahmad Fauzi, S.Pd',
                'email' => 'guru.ahmad@mitradidik.sch.id',
                'nip' => '198501102010011001',
                'bio' => 'Guru Matematika & Wali Kelas 7A yang berfokus pada logika menyenangkan.',
                'teaching_style' => 'Kontekstual & Problem Solving',
                'consult_hours' => 'Senin - Kamis, 14:00 - 16:00',
            ],
            [
                'name' => 'Siti Rahmawati, M.Pd',
                'email' => 'guru.siti@mitradidik.sch.id',
                'nip' => '198703152011012002',
                'bio' => 'Guru IPA & Wali Kelas 7B, mencintai eksperimen sains praktis.',
                'teaching_style' => 'Inquiry Learning & Hands-on Lab',
                'consult_hours' => 'Selasa & Jumat, 13:00 - 15:30',
            ],
            [
                'name' => 'Dewi Lestari, S.Pd',
                'email' => 'guru.dewi@mitradidik.sch.id',
                'nip' => '199002202014022003',
                'bio' => 'Guru Bahasa Indonesia, aktif dalam literasi dan menulis kreatif.',
                'teaching_style' => 'Apresiatif & Literasi Cerita',
                'consult_hours' => 'Rabu, 13:00 - 15:00',
            ],
            [
                'name' => 'Budi Santoso, M.Ed',
                'email' => 'guru.budi@mitradidik.sch.id',
                'nip' => '198308052008011004',
                'bio' => 'Guru Bahasa Inggris, mendorong keberanian berbicara aktif.',
                'teaching_style' => 'Communicative Approach',
                'consult_hours' => 'Kamis & Jumat, 10:00 - 12:00',
            ],
            [
                'name' => 'Joko Prasetyo, S.Pd',
                'email' => 'guru.joko@mitradidik.sch.id',
                'nip' => '198912122015031005',
                'bio' => 'Guru IPS, mengaitkan materi sejarah dengan isu sosial kekinian.',
                'teaching_style' => 'Diskusi Interaktif & Analisis Kasus',
                'consult_hours' => 'Senin, 13:00 - 15:00',
            ],
        ];

        $teachers = [];
        foreach ($teachersData as $t) {
            $user = User::create([
                'school_id' => $school->id,
                'name' => $t['name'],
                'email' => $t['email'],
                'password' => $passwordHash,
                'role' => 'teacher',
                'phone' => '0812' . rand(10000000, 99999999),
                'is_active' => true,
            ]);

            TeacherProfile::create([
                'user_id' => $user->id,
                'nip' => $t['nip'],
                'bio' => $t['bio'],
                'teaching_style' => $t['teaching_style'],
                'consult_hours' => $t['consult_hours'],
            ]);

            $teachers[$t['email']] = $user;
        }

        // 7. Alokasi Guru Mapel & Wali Kelas
        // Wali Kelas 7A: Ahmad Fauzi
        ClassTeacher::create([
            'class_id' => $class7A->id,
            'teacher_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
            'subject_id' => null,
            'is_homeroom' => true,
        ]);
        // Guru Matematika 7A
        ClassTeacher::create([
            'class_id' => $class7A->id,
            'teacher_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
            'subject_id' => $subMatematika->id,
            'is_homeroom' => false,
        ]);
        // Guru IPA 7A
        ClassTeacher::create([
            'class_id' => $class7A->id,
            'teacher_id' => $teachers['guru.siti@mitradidik.sch.id']->id,
            'subject_id' => $subIPA->id,
            'is_homeroom' => false,
        ]);
        // Guru B. Indonesia 7A
        ClassTeacher::create([
            'class_id' => $class7A->id,
            'teacher_id' => $teachers['guru.dewi@mitradidik.sch.id']->id,
            'subject_id' => $subBIndo->id,
            'is_homeroom' => false,
        ]);
        // Guru B. Inggris 7A
        ClassTeacher::create([
            'class_id' => $class7A->id,
            'teacher_id' => $teachers['guru.budi@mitradidik.sch.id']->id,
            'subject_id' => $subBInggris->id,
            'is_homeroom' => false,
        ]);

        // Wali Kelas 7B: Siti Rahmawati
        ClassTeacher::create([
            'class_id' => $class7B->id,
            'teacher_id' => $teachers['guru.siti@mitradidik.sch.id']->id,
            'subject_id' => null,
            'is_homeroom' => true,
        ]);
        // Guru IPA 7B
        ClassTeacher::create([
            'class_id' => $class7B->id,
            'teacher_id' => $teachers['guru.siti@mitradidik.sch.id']->id,
            'subject_id' => $subIPA->id,
            'is_homeroom' => false,
        ]);
        // Guru Matematika 7B
        ClassTeacher::create([
            'class_id' => $class7B->id,
            'teacher_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
            'subject_id' => $subMatematika->id,
            'is_homeroom' => false,
        ]);
        // Guru IPS 7B
        ClassTeacher::create([
            'class_id' => $class7B->id,
            'teacher_id' => $teachers['guru.joko@mitradidik.sch.id']->id,
            'subject_id' => $subIPS->id,
            'is_homeroom' => false,
        ]);

        // 8. Buat Kategori Merit & Demerit
        $merits = [
            ['name' => 'Juara Olimpiade / Lomba Tingkat Kota', 'points' => 25, 'severity_level' => 'berat', 'desc' => 'Mengharumkan nama sekolah di tingkat kota/provinsi'],
            ['name' => 'Kejujuran Mengembalikan Barang Temuan', 'points' => 15, 'severity_level' => 'sedang', 'desc' => 'Menunjukkan integritas dan budi pekerti luhur'],
            ['name' => 'Gotong Royong & Menolong Teman Sakit', 'points' => 10, 'severity_level' => 'ringan', 'desc' => 'Empati dan kepedulian sosial di lingkungan sekolah'],
            ['name' => 'Ketertiban & Kedisiplinan Sebulan Penuh', 'points' => 10, 'severity_level' => 'ringan', 'desc' => 'Tidak pernah terlambat dan atribut selalu lengkap'],
        ];
        foreach ($merits as $m) {
            BehaviorCategory::create([
                'school_id' => $school->id,
                'type' => 'merit',
                'name' => $m['name'],
                'points' => $m['points'],
                'severity_level' => $m['severity_level'],
                'description' => $m['desc'],
            ]);
        }

        $demerits = [
            ['name' => 'Terlambat Masuk Sekolah (>15 Menit)', 'points' => 5, 'severity_level' => 'ringan', 'desc' => 'Datang setelah gerbang sekolah ditutup tanpa surat keterangan'],
            ['name' => 'Atribut Seragam Tidak Lengkap', 'points' => 5, 'severity_level' => 'ringan', 'desc' => 'Tidak memakai dasi, sabuk, atau topi saat upacara'],
            ['name' => 'Menggunakan HP Saat KBM Tanpa Izin', 'points' => 10, 'severity_level' => 'sedang', 'desc' => 'Bermain game atau sosmed saat jam pelajaran'],
            ['name' => 'Tidak Mengumpulkan Tugas Berturut-turut', 'points' => 10, 'severity_level' => 'sedang', 'desc' => 'Melewati batas waktu lebih dari 3 kali berturut-turut'],
            ['name' => 'Tindakan Perundungan (Bullying) Verbal', 'points' => 25, 'severity_level' => 'berat', 'desc' => 'Menghina atau mengintimidasi teman secara verbal'],
        ];
        $demeritCats = [];
        foreach ($demerits as $d) {
            $cat = BehaviorCategory::create([
                'school_id' => $school->id,
                'type' => 'demerit',
                'name' => $d['name'],
                'points' => $d['points'],
                'severity_level' => $d['severity_level'],
                'description' => $d['desc'],
            ]);
            $demeritCats[] = $cat;
        }

        // 9. Buat 10 Siswa & 10 Orang Tua
        $studentsData = [
            // Kelas 7A (5 Siswa)
            ['class_id' => $class7A->id, 'nis' => '7001', 'name' => 'Adit Pratama', 'email' => 'adit.pratama@siswa.belajar.id', 'parent_name' => 'Bambang Pratama', 'parent_email' => 'ortu.adit@gmail.com', 'rel' => 'ayah'],
            ['class_id' => $class7A->id, 'nis' => '7002', 'name' => 'Bella Safitri', 'email' => 'bella.safitri@siswa.belajar.id', 'parent_name' => 'Sri Wahyuni', 'parent_email' => 'ortu.bella@gmail.com', 'rel' => 'ibu'],
            ['class_id' => $class7A->id, 'nis' => '7003', 'name' => 'Citra Kirana', 'email' => 'citra.kirana@siswa.belajar.id', 'parent_name' => 'Agus Haryanto', 'parent_email' => 'ortu.citra@gmail.com', 'rel' => 'ayah'],
            ['class_id' => $class7A->id, 'nis' => '7004', 'name' => 'Dimas Arya', 'email' => 'dimas.arya@siswa.belajar.id', 'parent_name' => 'Rina Marlina', 'parent_email' => 'ortu.dimas@gmail.com', 'rel' => 'ibu'],
            ['class_id' => $class7A->id, 'nis' => '7005', 'name' => 'Eka Putra', 'email' => 'eka.putra@siswa.belajar.id', 'parent_name' => 'Hadi Suwito', 'parent_email' => 'ortu.eka@gmail.com', 'rel' => 'wali'],

            // Kelas 7B (5 Siswa)
            ['class_id' => $class7B->id, 'nis' => '7006', 'name' => 'Farhan Ramadhan', 'email' => 'farhan.r@siswa.belajar.id', 'parent_name' => 'Dedi Iskandar', 'parent_email' => 'ortu.farhan@gmail.com', 'rel' => 'ayah'],
            ['class_id' => $class7B->id, 'nis' => '7007', 'name' => 'Gita Gutawa', 'email' => 'gita.g@siswa.belajar.id', 'parent_name' => 'Erna Susanti', 'parent_email' => 'ortu.gita@gmail.com', 'rel' => 'ibu'],
            ['class_id' => $class7B->id, 'nis' => '7008', 'name' => 'Haris Maulana', 'email' => 'haris.m@siswa.belajar.id', 'parent_name' => 'Lukman Hakim', 'parent_email' => 'ortu.haris@gmail.com', 'rel' => 'ayah'],
            ['class_id' => $class7B->id, 'nis' => '7009', 'name' => 'Intan Permata', 'email' => 'intan.p@siswa.belajar.id', 'parent_name' => 'Nurul Hidayati', 'parent_email' => 'ortu.intan@gmail.com', 'rel' => 'ibu'],
            ['class_id' => $class7B->id, 'nis' => '7010', 'name' => 'Jaka Tarub', 'email' => 'jaka.t@siswa.belajar.id', 'parent_name' => 'Mulyono', 'parent_email' => 'ortu.jaka@gmail.com', 'rel' => 'ayah'],
        ];

        $createdStudents = [];
        $createdGuardians = [];

        foreach ($studentsData as $idx => $s) {
            // Buat akun orang tua
            $guardian = User::create([
                'school_id' => $school->id,
                'name' => $s['parent_name'],
                'email' => $s['parent_email'],
                'password' => $passwordHash,
                'role' => 'guardian',
                'phone' => '0857' . rand(10000000, 99999999),
                'is_active' => true,
            ]);
            $createdGuardians[] = $guardian;

            // Buat data siswa
            $student = Student::create([
                'school_id' => $school->id,
                'class_id' => $s['class_id'],
                'nis' => $s['nis'],
                'nisn' => '0098' . rand(100000, 999999),
                'full_name' => $s['name'],
                'gclass_student_email' => $s['email'],
                'birth_date' => '2013-05-10',
            ]);
            $createdStudents[] = $student;

            // Hubungkan siswa dan wali
            StudentGuardian::create([
                'student_id' => $student->id,
                'guardian_id' => $guardian->id,
                'relation' => $s['rel'],
                'is_primary' => true,
            ]);

            // Inisialisasi Profil Karakter (100 demerit baseline, 0 merit)
            $demeritBaseline = 100;
            $meritBaseline = ($idx === 0) ? 20 : (($idx === 1) ? 10 : 0);
            $demeritCurrent = ($idx === 3) ? 80 : 100; // Dimas ada pelanggaran ringan (sisa 80)

            StudentBehaviorProfile::create([
                'student_id' => $student->id,
                'academic_year_id' => $academicYear->id,
                'initial_demerit_points' => 100,
                'current_demerit_points' => $demeritCurrent,
                'total_merit_points' => $meritBaseline,
                'warning_level' => StudentBehaviorProfile::calculateWarningLevel($demeritCurrent),
            ]);

            // Presensi Hari Ini (contoh untuk Adit Pratama = Hadir)
            Attendance::create([
                'student_id' => $student->id,
                'class_id' => $s['class_id'],
                'recorded_by' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
                'att_date' => Carbon::today(),
                'status' => ($idx === 1) ? 'terlambat' : (($idx === 2) ? 'sakit' : 'hadir'),
                'check_in_time' => ($idx === 1) ? '07:25:00' : '06:50:00',
                'minutes_late' => ($idx === 1) ? 15 : 0,
                'note' => ($idx === 1) ? 'Terjebak macet hujan pagi' : null,
            ]);
        }

        // 10. Buat Contoh Tugas & Nilai (Matematika & IPA)
        $tugas1 = Assignment::create([
            'class_id' => $class7A->id,
            'subject_id' => $subMatematika->id,
            'teacher_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
            'title' => 'Latihan 3: Aljabar Linear Satu Variabel',
            'description' => 'Kerjakan soal halaman 45 buku paket no. 1-10. Tuliskan langkah penyelesaian secara terstruktur di buku tugas.',
            'due_date' => Carbon::tomorrow()->setTime(23, 59, 0),
            'max_points' => 100.00,
            'source' => 'google_classroom',
            'sync_status' => 'synced',
        ]);

        $tugas2 = Assignment::create([
            'class_id' => $class7A->id,
            'subject_id' => $subIPA->id,
            'teacher_id' => $teachers['guru.siti@mitradidik.sch.id']->id,
            'title' => 'Laporan Praktikum: Uji Asam & Basa Rumah Tangga',
            'description' => 'Unggah foto lembar pengamatan indikator alami kunyit dan kubis ungu.',
            'due_date' => Carbon::today()->addDays(3)->setTime(17, 0, 0),
            'max_points' => 100.00,
            'source' => 'manual',
        ]);

        // Buat Submission untuk Adit Pratama (Sudah Dinilai: 95)
        AssignmentSubmission::create([
            'assignment_id' => $tugas1->id,
            'student_id' => $createdStudents[0]->id,
            'status' => 'dinilai',
            'submission_state' => 'RETURNED',
            'submitted_at' => Carbon::now()->subHours(5),
            'score' => 95.00,
            'teacher_feedback' => 'Bagus sekali Adit! Penjelasan variabel x sangat rapi dan tepat.',
            'graded_at' => Carbon::now()->subHours(2),
        ]);

        // 11. Buat Contoh Chat Room (Adit Pratama - Guru Ahmad Matematika & Wali Kelas)
        $roomMath = ChatRoom::create([
            'school_id' => $school->id,
            'student_id' => $createdStudents[0]->id,
            'class_id' => $class7A->id,
            'subject_id' => $subMatematika->id,
            'teacher_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id,
            'guardian_id' => $createdGuardians[0]->id,
            'room_type' => 'subject',
            'is_active' => true,
            'last_message_at' => Carbon::now()->subMinutes(15),
        ]);

        ChatMessage::create([
            'room_id' => $roomMath->id,
            'sender_id' => $createdGuardians[0]->id, // Pak Bambang
            'message_type' => 'text',
            'message' => 'Selamat siang Pak Ahmad, terima kasih atas nilai tugas Adit. Apakah untuk bab aljabar berikutnya ada materi pengayaan yang disarankan?',
            'status' => 'read',
            'deliver_at' => Carbon::now()->subMinutes(30),
            'read_at' => Carbon::now()->subMinutes(20),
        ]);

        ChatMessage::create([
            'room_id' => $roomMath->id,
            'sender_id' => $teachers['guru.ahmad@mitradidik.sch.id']->id, // Pak Ahmad
            'message_type' => 'text',
            'message' => 'Selamat siang Pak Bambang. Adit sangat cepat memahami konsep dasar. Boleh diajak membaca materi pemodelan soal cerita di Bab 4 ya Pak.',
            'status' => 'sent',
            'deliver_at' => Carbon::now()->subMinutes(15),
        ]);
    }
}
