<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();

            // Association relationship
            $table->foreignId('association_id')
                  ->constrained('associations')
                  ->onDelete('cascade')
                  ->comment('الجمعية');

            // Family head (father) reference
            $table->foreignId('father_id')
                  ->nullable()
                  ->constrained('persons')
                  ->onDelete('set null')
                  ->comment('رب الأسرة');

            // Family details
            $table->string('family_card_number')
                  ->unique()
                  ->comment('رقم البطاقة العائلية');
                  
            $table->date('registration_date')
                  ->useCurrent()
                  ->comment('تاريخ التسجيل');
                  
            $table->enum('housing_status', ['مستأجر', 'مستفيد من سكن حكومي', 'يمتلك سكناً'])
                  ->default('مستأجر')
                  ->comment('حالة السكن');
                  
            $table->text('address')
                  ->nullable()
                  ->comment('عنوان السكن الحالي');
                  
            $table->text('notes')
                  ->nullable()
                  ->comment('ملاحظات');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
};