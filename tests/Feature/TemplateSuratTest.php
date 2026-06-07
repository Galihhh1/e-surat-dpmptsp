<?php

use App\Models\User;
use App\Models\TemplateSurat;
use App\Models\SuratKeluar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest or standard user cannot access template index', function () {
    $guestResponse = $this->get(route('template-surats.index'));
    $guestResponse->assertRedirect(route('login'));

    $user = User::factory()->create(['role' => 'user_bidang']);
    $userResponse = $this->actingAs($user)->get(route('template-surats.index'));
    $userResponse->assertStatus(403);
});

test('admin tu can access template index', function () {
    $admin = User::factory()->create(['role' => 'admin_tu']);
    $response = $this->actingAs($admin)->get(route('template-surats.index'));
    $response->assertStatus(200);
});

test('admin tu can create a template', function () {
    $admin = User::factory()->create(['role' => 'admin_tu']);
    
    $response = $this->actingAs($admin)->post(route('template-surats.store'), [
        'nama_template' => 'Template Undangan Baru',
        'jenis_template' => 'Undangan',
        'isi_template' => '<p>Halo {{ nama_pemohon }}</p>',
        'status' => 'aktif',
    ]);

    $response->assertRedirect(route('template-surats.index'));
    $this->assertDatabaseHas('template_surats', [
        'nama_template' => 'Template Undangan Baru',
        'jenis_template' => 'Undangan',
        'status' => 'aktif',
    ]);
});

test('admin tu can update a template', function () {
    $admin = User::factory()->create(['role' => 'admin_tu']);
    $template = TemplateSurat::create([
        'nama_template' => 'Template Lama',
        'jenis_template' => 'Lama',
        'isi_template' => '<p>Konten Lama</p>',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($admin)->put(route('template-surats.update', $template->id), [
        'nama_template' => 'Template Baru',
        'jenis_template' => 'Baru',
        'isi_template' => '<p>Konten Baru</p>',
        'status' => 'nonaktif',
    ]);

    $response->assertRedirect(route('template-surats.index'));
    $this->assertDatabaseHas('template_surats', [
        'id' => $template->id,
        'nama_template' => 'Template Baru',
        'status' => 'nonaktif',
    ]);
});

test('admin tu can delete a template', function () {
    $admin = User::factory()->create(['role' => 'admin_tu']);
    $template = TemplateSurat::create([
        'nama_template' => 'Template Hapus',
        'jenis_template' => 'Hapus',
        'isi_template' => '<p>Konten Hapus</p>',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($admin)->delete(route('template-surats.destroy', $template->id));

    $response->assertRedirect(route('template-surats.index'));
    $this->assertDatabaseMissing('template_surats', [
        'id' => $template->id,
    ]);
});

test('admin tu can create surat keluar with template id', function () {
    $admin = User::factory()->create(['role' => 'admin_tu']);
    $template = TemplateSurat::create([
        'nama_template' => 'Template Surat Keluar',
        'jenis_template' => 'Undangan',
        'isi_template' => '<p>Nomor: {{ nomor_surat }}</p>',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($admin)->post(route('surat-keluars.store'), [
        'tujuan_surat' => 'Kepala Dinas Pertanian',
        'perihal' => 'Rapat Rencana',
        'jenis_surat' => 'Undangan',
        'tanggal_surat' => '2026-06-01',
        'template_surat_id' => $template->id,
        'isi_surat' => '<p>Nomor: 001/DPMPTSP/VI/2026</p>',
    ]);

    $response->assertRedirect(route('surat-keluars.index'));
    $this->assertDatabaseHas('surat_keluars', [
        'tujuan_surat' => 'Kepala Dinas Pertanian',
        'template_surat_id' => $template->id,
    ]);
});
