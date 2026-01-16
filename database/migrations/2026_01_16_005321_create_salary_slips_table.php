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
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('slip_number')->unique(); // e.g., SLIP/2026/01/001
            $table->integer('period_month'); // 1-12
            $table->integer('period_year'); // e.g. 2026
            $table->decimal('salary', 15, 2); // Basic Salary
            $table->decimal('bonus', 15, 2)->default(0); // Tunjangan / Bonus
            $table->decimal('deduction', 15, 2)->default(0); // Potongan
            $table->decimal('net_salary', 15, 2); // Final amount
            $table->enum('status', ['draft', 'paid'])->default('draft');
            $table->date('payment_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
    }
};
