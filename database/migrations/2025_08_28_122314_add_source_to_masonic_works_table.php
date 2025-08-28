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
        Schema::table('masonic_works', function (Blueprint $table) {
            $table->string('source')->default('Propio')->after('document_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masonic_works', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};