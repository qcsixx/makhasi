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
        // Add unique constraint to prevent duplicate library entries
        Schema::table('library', function (Blueprint $table) {
            $table->unique(['user_id', 'makanan_id'], 'library_user_makanan_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('library', function (Blueprint $table) {
            $table->dropUnique('library_user_makanan_unique');
        });
    }
};
