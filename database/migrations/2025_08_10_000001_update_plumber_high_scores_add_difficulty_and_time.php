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
        Schema::table('plumber_high_scores', function (Blueprint $table) {
            $table->string('difficulty')->default('normal')->after('score');
            $table->integer('time')->default(0)->after('difficulty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plumber_high_scores', function (Blueprint $table) {
            $table->dropColumn('difficulty');
            $table->dropColumn('time');
        });
    }
};
