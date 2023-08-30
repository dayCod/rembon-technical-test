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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->constrained('user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('kode_pesanan', 10)->nullable();
            $table->timestamp('tgl_pesanan')->nullable();
            $table->string('kode_voucher', 20)->nullable();
            $table->timestamp('tgl_pembayaran_lunas')->nullable();
            $table->timestamp('tgl_dibatalkan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
