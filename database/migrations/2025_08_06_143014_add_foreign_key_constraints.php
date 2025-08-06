<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add foreign key constraints to families table
        Schema::table('families', function (Blueprint $table) {
            $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
            $table->foreign('father_id')->references('id')->on('persons')->onDelete('set null');
        });

        // Add foreign key constraints to persons table
        Schema::table('persons', function (Blueprint $table) {
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('father_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('mother_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('spouse_id')->references('id')->on('persons')->onDelete('set null');
        });

        // Add foreign key constraints to beneficiaries table
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
        });

        // Add foreign key constraints to aid_records table
        Schema::table('aid_records', function (Blueprint $table) {
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('cascade');
            $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Remove foreign key constraints from aid_records table
        Schema::table('aid_records', function (Blueprint $table) {
            $table->dropForeign(['beneficiary_id']);
            $table->dropForeign(['association_id']);
        });

        // Remove foreign key constraints from beneficiaries table
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropForeign(['family_id']);
        });

        // Remove foreign key constraints from persons table
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['family_id']);
            $table->dropForeign(['father_id']);
            $table->dropForeign(['mother_id']);
            $table->dropForeign(['spouse_id']);
        });

        // Remove foreign key constraints from families table
        Schema::table('families', function (Blueprint $table) {
            $table->dropForeign(['association_id']);
            $table->dropForeign(['father_id']);
        });
    }
};
