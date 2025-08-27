<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Degree;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Add the new nullable degree_id column
            $table->unsignedBigInteger('degree_id')->nullable()->after('degree');
        });

        // 2. Migrate existing data from 'degree' to 'degree_id'
        // This assumes Degree IDs 1, 2, 3 correspond to Aprendiz, Compañero, Maestro
        // Adjust if your seeded IDs are different
        $aprendizId = Degree::where('name', 'Aprendiz')->first()->id ?? null;
        $companeroId = Degree::where('name', 'Compañero')->first()->id ?? null;
        $maestroId = Degree::where('name', 'Maestro')->first()->id ?? null;

        DB::table('users')->where('degree', 1)->update(['degree_id' => $aprendizId]);
        DB::table('users')->where('degree', 2)->update(['degree_id' => $companeroId]);
        DB::table('users')->where('degree', 3)->update(['degree_id' => $maestroId]);

        Schema::table('users', function (Blueprint $table) {
            // 3. Drop the old 'degree' column
            $table->dropColumn('degree');

            // 4. Add foreign key constraint and make degree_id not nullable
            // Ensure all existing users have a degree_id before making it not nullable
            // For now, we'll keep it nullable to avoid errors if some users don't have a mapped degree
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse: Drop foreign key and degree_id, add back old degree column
            $table->dropForeign(['degree_id']);
            $table->dropColumn('degree_id');
            $table->integer('degree')->nullable(); // Re-add as nullable
        });
    }
};