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
        // Cek jika tabel sudah ada, kita modifikasi isinya atau drop dulu jika masih kosong/dev mode
        if (Schema::hasTable('leads')) {
            // Jika status masih error "truncated", kemungkinan kolomnya kependekan.
            // Kita ubah tipe datanya.
            Schema::table('leads', function (Blueprint $table) {
                // Pastikan kolom status cukup panjang (misal 50 karakter)
                $table->string('status', 50)->change();

                // Tambahkan softDeletes agar mirip dengan clients (opsional tapi disarankan)
                if (! Schema::hasColumn('leads', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        } else {
            // Jika tabel belum ada, buat baru dengan struktur yang benar
            Schema::create('leads', function (Blueprint $table) {
                $table->uuid('id')->primary(); // Menggunakan UUID sesuai Lead.php
                $table->string('name');
                $table->string('email');
                $table->string('source')->nullable();         // Misal: Google, Facebook
                $table->string('status', 50)->default('New'); // Panjang 50 agar muat 'Lost', 'Qualified', dll
                $table->timestamps();
                $table->softDeletes(); // Konsisten dengan tabel clients
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
