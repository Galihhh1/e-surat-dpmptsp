<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin_tu', 'user_bidang'])->default('user_bidang')->after('password');
        $table->foreignId('bidang_id')->nullable()->after('role')->constrained('bidangs')->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['bidang_id']);
        $table->dropColumn(['role', 'bidang_id']);
    });
}
};
