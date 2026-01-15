<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_type',
        'full_name',
        'id_number',
        'email',
        'phone',
        'address',
        'position',
        'join_date',
        'contract_start',
        'contract_end',
        'is_permanent',
        'status',
        'salary',
        'notes',
        'reminder_days',
    ];

    protected $casts = [
        'join_date' => 'date',
        'contract_start' => 'date',
        'contract_end' => 'date',
        'is_permanent' => 'boolean',
        'salary' => 'decimal:2',
    ];

    /**
     * Get all documents for this employee
     */
    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class)->orderBy('upload_date', 'desc');
    }

    /**
     * Get the Indonesian label for employee type
     */
    public function getEmployeeTypeLabel(): string
    {
        return match($this->employee_type) {
            'owner' => 'Pemilik / Direktur',
            'freelancer' => 'Freelancer',
            'contract' => 'Karyawan Kontrak (PKWT)',
            default => $this->employee_type,
        };
    }

    /**
     * Get the Indonesian label for status
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'active' => 'Aktif',
            'contract_ending' => 'Kontrak Akan Berakhir',
            'inactive' => 'Tidak Aktif',
            default => $this->status,
        };
    }

    /**
     * Get the badge color class for status
     */
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'active' => 'bg-green-200',
            'contract_ending' => 'bg-yellow-200',
            'inactive' => 'bg-red-200',
            default => 'bg-gray-200',
        };
    }

    /**
     * Check if contract is ending soon
     */
    public function isContractEnding(): bool
    {
        if ($this->employee_type === 'owner' || $this->is_permanent || !$this->contract_end) {
            return false;
        }
        
        if ($this->isContractExpired()) {
            return false;
        }
        
        $reminderDate = now()->addDays($this->reminder_days);
        return $this->contract_end->lte($reminderDate);
    }

    /**
     * Check if contract has expired
     */
    public function isContractExpired(): bool
    {
        if ($this->employee_type === 'owner' || $this->is_permanent || !$this->contract_end) {
            return false;
        }
        
        return $this->contract_end->isPast();
    }

    /**
     * Get days until contract end
     */
    public function getDaysUntilContractEnd(): ?int
    {
        if ($this->employee_type === 'owner' || $this->is_permanent || !$this->contract_end) {
            return null;
        }
        
        return now()->diffInDays($this->contract_end, false);
    }

    /**
     * Update status based on contract dates
     */
    public function updateStatus(): void
    {
        if ($this->employee_type === 'owner') {
            $this->status = 'active';
        } elseif ($this->is_permanent) {
            $this->status = 'active';
        } elseif ($this->isContractExpired()) {
            $this->status = 'inactive';
        } elseif ($this->isContractEnding()) {
            $this->status = 'contract_ending';
        } else {
            $this->status = 'active';
        }
        
        $this->saveQuietly();
    }

    /**
     * Get contract status color for display
     */
    public function getContractColorClass(): string
    {
        if ($this->employee_type === 'owner') {
            return 'text-blue-700';
        } elseif ($this->is_permanent) {
            return 'text-blue-700';
        } elseif ($this->isContractExpired()) {
            return 'text-red-700 font-bold';
        } elseif ($this->isContractEnding()) {
            return 'text-yellow-700 font-bold';
        }
        return 'text-green-700';
    }
}
