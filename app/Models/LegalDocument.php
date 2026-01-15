<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LegalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'document_number',
        'document_name',
        'issuer',
        'issue_date',
        'expiry_date',
        'is_permanent',
        'file_path',
        'notes',
        'status',
        'reminder_days',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'is_permanent' => 'boolean',
    ];

    /**
     * Get the Indonesian label for document type
     */
    public function getDocumentTypeLabel(): string
    {
        return match($this->document_type) {
            'akta_pendirian' => 'Akta Pendirian',
            'sk_kemenkumham' => 'SK Kemenkumham',
            'npwp' => 'NPWP',
            'nib' => 'NIB',
            'siup' => 'SIUP',
            'tdp' => 'TDP',
            'other' => 'Lainnya',
            default => $this->document_type,
        };
    }

    /**
     * Get the Indonesian label for status
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'active' => 'Aktif',
            'expired' => 'Kadaluarsa',
            'pending_renewal' => 'Perlu Diperpanjang',
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
            'expired' => 'bg-red-200',
            'pending_renewal' => 'bg-yellow-200',
            default => 'bg-gray-200',
        };
    }

    /**
     * Check if document has expired
     */
    public function isExpired(): bool
    {
        if ($this->is_permanent || !$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    /**
     * Check if document is expiring soon
     */
    public function isExpiringSoon(): bool
    {
        if ($this->is_permanent || !$this->expiry_date || $this->isExpired()) {
            return false;
        }
        
        $reminderDate = now()->addDays($this->reminder_days);
        return $this->expiry_date->lte($reminderDate);
    }

    /**
     * Get days until expiry
     */
    public function getDaysUntilExpiry(): ?int
    {
        if ($this->is_permanent || !$this->expiry_date) {
            return null;
        }
        
        return now()->diffInDays($this->expiry_date, false);
    }

    /**
     * Update status based on expiry date
     */
    public function updateStatus(): void
    {
        if ($this->is_permanent) {
            $this->status = 'active';
        } elseif ($this->isExpired()) {
            $this->status = 'expired';
        } elseif ($this->isExpiringSoon()) {
            $this->status = 'pending_renewal';
        } else {
            $this->status = 'active';
        }
        
        $this->saveQuietly(); // Save without triggering events
    }

    /**
     * Get expiry status color for display
     */
    public function getExpiryColorClass(): string
    {
        if ($this->is_permanent) {
            return 'text-blue-700';
        } elseif ($this->isExpired()) {
            return 'text-red-700 font-bold';
        } elseif ($this->isExpiringSoon()) {
            return 'text-yellow-700 font-bold';
        }
        return 'text-green-700';
    }
}
