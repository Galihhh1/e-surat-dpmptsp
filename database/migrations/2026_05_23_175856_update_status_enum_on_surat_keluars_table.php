<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE surat_keluars MODIFY status ENUM('draft', 'dikirim', 'selesai', 'arsip') DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE surat_keluars MODIFY status ENUM('draft', 'dikirim', 'selesai') DEFAULT 'draft'");
    }
};