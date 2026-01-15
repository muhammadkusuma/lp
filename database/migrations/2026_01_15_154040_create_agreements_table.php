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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('agreement_number', 100)->unique();
            $table->enum('type', ['non_profit', 'freelancer', 'pkwt']);
            $table->string('party_name');
            $table->string('party_contact')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'expired', 'extended'])->default('active');
            $table->text('description')->nullable();
            $table->string('current_file_path')->nullable();
            $table->integer('current_version')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
