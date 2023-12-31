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
        Schema::create('produk_pesanan', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('pesanan_id')->constrained('pesanan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('jumlah')->default(1);
            $table->timestamp('tgl_dibuat')->nullable();
            $table->timestamp('tgl_diubah')->nullable();
            $table->timestamp('tgl_dihapus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_pesanan');
    }
};
