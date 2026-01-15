<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'document_type',
        'document_name',
        'file_path',
        'upload_date',
        'expiry_date',
        'notes',
    ];

    protected $casts = [
        'upload_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the employee this document belongs to
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the Indonesian label for document type
     */
    public function getDocumentTypeLabel(): string
    {
        return match($this->document_type) {
            'ktp' => 'KTP',
            'npwp' => 'NPWP',
            'cv' => 'CV / Resume',
            'contract' => 'Kontrak Kerja',
            'certificate' => 'Sertifikat / Ijazah',
            'other' => 'Lainnya',
            default => $this->document_type,
        };
    }

    /**
     * Get badge color for document type
     */
    public function getDocumentTypeBadgeColor(): string
    {
        return match($this->document_type) {
            'ktp' => 'bg-blue-100',
            'npwp' => 'bg-green-100',
            'cv' => 'bg-purple-100',
            'contract' => 'bg-red-100',
            'certificate' => 'bg-yellow-100',
            'other' => 'bg-gray-100',
            default => 'bg-gray-100',
        };
    }

    /**
     * Check if document is expiring soon (within 30 days)
     */
    public function isExpiringSoon(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        if ($this->expiry_date->isPast()) {
            return false; // Already expired
        }

        $daysUntilExpiry = now()->diffInDays($this->expiry_date, false);
        return $daysUntilExpiry <= 30 && $daysUntilExpiry >= 0;
    }

    /**
     * Check if document has expired
     */
    public function isExpired(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        return $this->expiry_date->isPast();
    }
}

