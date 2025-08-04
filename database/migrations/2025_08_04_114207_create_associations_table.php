<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('associations', function (Blueprint $table) {
            // Rename the original name column to name_en first
            $table->renameColumn('name', 'name_en');
        });

        Schema::table('associations', function (Blueprint $table) {
            $table->string('name_ar')->default('')->after('name_en')->comment('اسم الجمعية بالعربية');
            $table->string('address')->nullable()->comment('عنوان الجمعية');
            $table->string('phone')->nullable()->comment('هاتف الجمعية');
            $table->string('email')->nullable()->comment('البريد الإلكتروني');
            $table->string('website')->nullable()->comment('الموقع الإلكتروني');
            $table->text('description')->nullable()->comment('وصف الجمعية');
            $table->boolean('is_active')->default(true)->comment('نشط');
        });
    }

    public function down()
    {
        Schema::table('associations', function (Blueprint $table) {
            $table->dropColumn([
                'name_ar',
                'address',
                'phone',
                'email',
                'website',
                'description',
                'is_active'
            ]);
        });

        Schema::table('associations', function (Blueprint $table) {
            $table->renameColumn('name_en', 'name');
        });
    }
};
