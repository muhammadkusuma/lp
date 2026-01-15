<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'agreement_number',
        'type',
        'party_name',
        'party_contact',
        'start_date',
        'end_date',
        'status',
        'description',
        'current_file_path',
        'current_version',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get all versions of this agreement
     */
    public function versions()
    {
        return $this->hasMany(AgreementVersion::class)->orderBy('version_number', 'desc');
    }

    /**
     * Get the Indonesian label for agreement type
     */
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'non_profit' => 'Perjanjian Non-Profit / Kemitraan',
            'freelancer' => 'Perjanjian Freelancer',
            'pkwt' => 'Perjanjian Kontrak Karyawan (PKWT)',
            default => $this->type,
        };
    }

    /**
     * Get the Indonesian label for status
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'active' => 'Aktif',
            'expired' => 'Berakhir',
            'extended' => 'Diperpanjang',
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
            'extended' => 'bg-yellow-200',
            default => 'bg-gray-200',
        };
    }

    /**
     * Check if agreement is expired based on end_date
     */
    public function isExpired(): bool
    {
        if (!$this->end_date) {
            return false;
        }
        return $this->end_date->isPast();
    }
}
