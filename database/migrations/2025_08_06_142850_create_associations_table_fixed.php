<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->comment('اسم الجمعية بالإنجليزية');
            $table->string('name_ar')->default('')->comment('اسم الجمعية بالعربية');
            $table->string('address')->nullable()->comment('عنوان الجمعية');
            $table->string('phone')->nullable()->comment('هاتف الجمعية');
            $table->string('email')->nullable()->comment('البريد الإلكتروني');
            $table->string('website')->nullable()->comment('الموقع الإلكتروني');
            $table->text('description')->nullable()->comment('وصف الجمعية');
            $table->boolean('is_active')->default(true)->comment('نشط');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('associations');
    }
};
