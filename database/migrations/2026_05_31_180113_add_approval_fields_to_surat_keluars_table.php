<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->foreignId('approved_by')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->text('catatan_approval')->nullable()->after('approved_at');
            $table->text('catatan_penolakan')->nullable()->after('catatan_approval');
        });

        DB::statement("ALTER TABLE surat_keluars MODIFY status ENUM('draft', 'menunggu_persetujuan', 'disetujui', 'ditolak', 'dikirim', 'selesai', 'arsip') DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE surat_keluars MODIFY status ENUM('draft', 'dikirim', 'selesai', 'arsip') DEFAULT 'draft'");

        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['approved_by', 'approved_at', 'catatan_approval', 'catatan_penolakan']);
        });
    }
};
