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
            $table->foreignId('family_id')->constrained('families')->onDelete('cascade')->comment('العائلة');
            
            // Parent relationships
            $table->foreignId('father_id')->nullable()->constrained('persons')->onDelete('set null')->comment('الأب');
            $table->foreignId('mother_id')->nullable()->constrained('persons')->onDelete('set null')->comment('الأم');
            
            // Track if this person is the family head (father)
            $table->boolean('is_family_head')->default(false)->comment('رب الأسرة');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
};