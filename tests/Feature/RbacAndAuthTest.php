<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\School;

class RbacAndAuthTest extends TestCase
{
    /**
     * Pengguna belum login otomatis diarahkan ke halaman /login.
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/teacher/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/guardian/dashboard');
        $response->assertRedirect('/login');
    }

    /**
     * Admin berhak membuka dasbor admin, namun ditolak di dasbor guru & wali.
     */
    public function test_admin_rbac_access(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $this->markTestSkipped('Admin user not seeded.');
        }

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/teacher/dashboard')
            ->assertStatus(403);
    }

    /**
     * Guru berhak membuka dasbor guru, namun ditolak di dasbor admin.
     */
    public function test_teacher_rbac_access(): void
    {
        $teacher = User::where('role', 'teacher')->first();
        if (!$teacher) {
            $this->markTestSkipped('Teacher user not seeded.');
        }

        $this->actingAs($teacher)
            ->get('/teacher/dashboard')
            ->assertStatus(200);

        $this->actingAs($teacher)
            ->get('/admin/dashboard')
            ->assertStatus(403);
    }

    /**
     * Orang tua berhak membuka dasbor wali, namun ditolak di dasbor admin.
     */
    public function test_guardian_rbac_access(): void
    {
        $guardian = User::where('role', 'guardian')->first();
        if (!$guardian) {
            $this->markTestSkipped('Guardian user not seeded.');
        }

        $this->actingAs($guardian)
            ->get('/guardian/dashboard')
            ->assertStatus(200);

        $this->actingAs($guardian)
            ->get('/admin/dashboard')
            ->assertStatus(403);
    }
}

