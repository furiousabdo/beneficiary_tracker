<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->enum('relationship_to_family_head', [
                'رب الأسرة', // Family Head
                'زوجة', // Wife
                'ابن', // Son
                'ابنة', // Daughter
                'أب', // Father
                'أم', // Mother
                'أخ', // Brother
                'أخت', // Sister
                'جد', // Grandfather
                'جدة', // Grandmother
                'عم', // Uncle (Father's Brother)
                'عمة', // Aunt (Father's Sister)
                'خال', // Uncle (Mother's Brother)
                'خالة', // Aunt (Mother's Sister)
                'ابن الأخ', // Nephew (Brother's Son)
                'ابنة الأخ', // Niece (Brother's Daughter)
                'ابن الأخت', // Nephew (Sister's Son)
                'ابنة الأخت', // Niece (Sister's Daughter)
                'حفيد', // Grandson
                'حفيدة', // Granddaughter
                'أخرى' // Other
            ])->nullable()->after('spouse_id')->comment('العلاقة برب الأسرة');
        });
    }

    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropColumn('relationship_to_family_head');
        });
    }
};
