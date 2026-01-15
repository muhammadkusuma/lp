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
        Schema::create('legal_documents', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['akta_pendirian', 'sk_kemenkumham', 'npwp', 'nib', 'siup', 'tdp', 'other']);
            $table->string('document_number', 100);
            $table->string('document_name');
            $table->string('issuer');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->string('file_path')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'expired', 'pending_renewal'])->default('active');
            $table->integer('reminder_days')->default(30);
            $table->timestamps();
            
            $table->index('document_type');
            $table->index('expiry_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_documents');
    }
};
