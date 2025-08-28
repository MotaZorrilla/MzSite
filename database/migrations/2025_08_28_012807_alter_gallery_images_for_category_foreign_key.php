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
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->unsignedBigInteger('image_category_id')->nullable()->after('title');
            $table->foreign('image_category_id')->references('id')->on('image_categories')->onDelete('set null');

            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');

            $table->dropForeign(['image_category_id']);
            $table->dropColumn('image_category_id');
        });
    }
};