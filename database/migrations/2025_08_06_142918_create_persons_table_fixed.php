<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->comment('الاسم بالعربية');
            $table->string('name_en')->nullable()->comment('Name in English');
            $table->string('national_id')->unique()->comment('الرقم القومي');
            $table->date('birth_date')->nullable()->comment('تاريخ الميلاد');
            $table->string('phone')->nullable()->comment('رقم الهاتف');
            $table->enum('gender', ['ذكر', 'أنثى'])->comment('النوع');
            $table->enum('marital_status', ['أعزب', 'متزوج', 'مطلق', 'أرمل'])->default('أعزب')->comment('الحالة الاجتماعية');
            $table->string('occupation')->nullable()->comment('المهنة');
            $table->text('address')->nullable()->comment('العنوان');
            
            // Family relationship
            $table->foreignId('family_id')->nullable()->comment('العائلة');
            
            // Parent relationships
            $table->foreignId('father_id')->nullable()->comment('الأب');
            $table->foreignId('mother_id')->nullable()->comment('الأم');
            
            // Spouse relationship
            $table->foreignId('spouse_id')->nullable()->comment('الزوج/الزوجة');
            
            // Track if this person is the family head (father)
            $table->boolean('is_family_head')->default(false)->comment('رب الأسرة');
            
            // Relationship to family head
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
            ])->nullable()->comment('العلاقة برب الأسرة');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
};
