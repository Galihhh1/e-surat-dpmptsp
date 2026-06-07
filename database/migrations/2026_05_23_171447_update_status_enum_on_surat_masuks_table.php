<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE surat_masuks MODIFY status ENUM('masuk', 'didisposisikan', 'diproses', 'selesai', 'arsip') DEFAULT 'masuk'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE surat_masuks MODIFY status ENUM('masuk', 'didisposisikan', 'diproses', 'selesai') DEFAULT 'masuk'");
    }
};