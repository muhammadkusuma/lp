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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('employee_type', ['owner', 'freelancer', 'contract']);
            $table->string('full_name');
            $table->string('id_number', 50)->unique();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('position');
            $table->date('join_date');
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->enum('status', ['active', 'contract_ending', 'inactive'])->default('active');
            $table->decimal('salary', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->integer('reminder_days')->default(30);
            $table->timestamps();
            
            $table->index('employee_type');
            $table->index('contract_end');
            $table->index('status');
            $table->index('id_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
