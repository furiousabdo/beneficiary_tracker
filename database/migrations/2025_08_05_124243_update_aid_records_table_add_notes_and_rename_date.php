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
        Schema::table('aid_records', function (Blueprint $table) {
            // Rename date_given to date
            $table->renameColumn('date_given', 'date');
            
            // Add notes field
            $table->text('notes')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aid_records', function (Blueprint $table) {
            // Remove notes field
            $table->dropColumn('notes');
            
            // Rename date back to date_given
            $table->renameColumn('date', 'date_given');
        });
    }
};
