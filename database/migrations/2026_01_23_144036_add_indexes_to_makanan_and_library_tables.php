<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('makanan', function (Blueprint $table) {
            // Index for search queries
            $table->index('nama');
            // Index for filter by daerah
            $table->index('daerah_id');
            // Index for sorting by created_at
            $table->index('created_at');
        });

        Schema::table('library', function (Blueprint $table) {
            // Composite index for user's library queries
            $table->index(['user_id', 'makanan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('makanan', function (Blueprint $table) {
            $table->dropIndex(['nama']);
            $table->dropIndex(['daerah_id']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('library', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'makanan_id']);
        });
    }
};
