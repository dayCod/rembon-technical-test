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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_depan', 30);
            $table->string('nama_belakang', 30);
            $table->string('alamat', 200)->nullable();
            $table->string('nomor_hp', 15)->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->date('tgl_lahir');
            $table->timestamp('tgl_dibuat')->nullable();
            $table->timestamp('tgl_diubah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
