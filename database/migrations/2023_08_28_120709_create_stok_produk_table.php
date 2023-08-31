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
        Schema::create('Mst.stok_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->references('id')
                ->on('Usr.user')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('stok')->default(0);
            $table->timestamp('tgl_diubah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_produk');
    }
};
