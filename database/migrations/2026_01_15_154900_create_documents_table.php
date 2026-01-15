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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number', 50)->unique();
            $table->enum('direction', ['incoming', 'outgoing']);
            $table->string('title');
            $table->enum('classification', ['legal', 'keuangan', 'operasional', 'sdm', 'umum']);
            $table->string('sender')->nullable();
            $table->string('recipient')->nullable();
            $table->date('document_date');
            $table->date('received_date')->nullable();
            $table->date('sent_date')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->text('keywords')->nullable();
            $table->enum('status', ['draft', 'processed', 'archived'])->default('processed');
            $table->timestamps();
            
            $table->index('document_number');
            $table->index('direction');
            $table->index('classification');
            $table->index('document_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
