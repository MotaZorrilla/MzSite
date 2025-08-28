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
            $table->unsignedBigInteger('document_category_id')->nullable()->after('description');
            $table->foreign('document_category_id')->references('id')->on('document_categories')->onDelete('set null');

            $table->dropColumn('category');
            $table->dropColumn('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masonic_works', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('source')->nullable()->after('category');

            $table->dropForeign(['document_category_id']);
            $table->dropColumn('document_category_id');
        });
    }
};