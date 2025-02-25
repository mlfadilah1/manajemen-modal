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
        Schema::create('analisis_pendapatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('biaya_tetap', 15, 2);
            $table->decimal('biaya_variabel_per_unit', 15, 2);
            $table->decimal('harga_jual_per_unit', 15, 2);
            $table->unsignedInteger('bep_unit');
            $table->decimal('bep_rupiah', 15, 2);
            $table->decimal('total_pendapatan', 15, 2);
            // $table->decimal('biaya_operasional', 15, 2);
            $table->decimal('total_investasi', 15, 2);
            $table->decimal('laba_bersih', 15, 2);
            $table->decimal('roi', 8, 2);
            $table->date('periode_analisis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisi_pendapatans');
    }
};
