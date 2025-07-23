<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aid_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->constrained('beneficiaries')->onDelete('cascade');
            $table->foreignId('association_id')->constrained('associations')->onDelete('cascade');
            $table->string('aid_type');
            $table->decimal('amount', 10, 2)->default(0);
            $table->date('date_given');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aid_records');
    }
}; 