<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(DB::raw("CREATE SCHEMA IF NOT EXISTS Mst"));
        DB::statement(DB::raw("CREATE SCHEMA IF NOT EXISTS Usr"));
        DB::statement(DB::raw("CREATE SCHEMA IF NOT EXISTS Trx"));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(DB::raw("DROP SCHEMA IF EXISTS Mst"));
        DB::statement(DB::raw("DROP SCHEMA IF EXISTS Usr"));
        DB::statement(DB::raw("DROP SCHEMA IF EXISTS Trx"));
    }
};
