<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->foreignId('spouse_id')->nullable()->after('mother_id')->constrained('persons')->onDelete('set null')->comment('الزوج/الزوجة');
        });
    }

    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['spouse_id']);
            $table->dropColumn('spouse_id');
        });
    }
};
