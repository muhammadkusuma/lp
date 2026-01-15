<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number',
        'direction',
        'title',
        'classification',
        'sender',
        'recipient',
        'document_date',
        'received_date',
        'sent_date',
        'description',
        'file_path',
        'keywords',
        'status',
    ];

    protected $casts = [
        'document_date' => 'date',
        'received_date' => 'date',
        'sent_date' => 'date',
    ];

    /**
     * Generate unique document number based on direction
     */
    public static function generateDocumentNumber($direction)
    {
        $prefix = $direction === 'incoming' ? 'IN' : 'OUT';
        $year = date('Y');
        $month = date('m');
        
        // Get last document number for this direction, year, and month
        $lastDocument = self::where('direction', $direction)
            ->where('document_number', 'LIKE', "{$prefix}/{$year}/{$month}/%")
            ->orderBy('document_number', 'desc')
            ->first();
        
        if ($lastDocument) {
            // Extract sequence number from last document
            $parts = explode('/', $lastDocument->document_number);
            $lastSequence = (int) end($parts);
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }
        
        // Format: PREFIX/YYYY/MM/NNNN
        return sprintf('%s/%s/%s/%04d', $prefix, $year, $month, $newSequence);
    }

    /**
     * Get the Indonesian label for direction
     */
    public function getDirectionLabel(): string
    {
        return match($this->direction) {
            'incoming' => 'Dokumen Masuk',
            'outgoing' => 'Dokumen Keluar',
            default => $this->direction,
        };
    }

    /**
     * Get the Indonesian label for classification
     */
    public function getClassificationLabel(): string
    {
        return match($this->classification) {
            'legal' => 'Legal',
            'keuangan' => 'Keuangan',
            'operasional' => 'Operasional',
            'sdm' => 'SDM',
            'umum' => 'Umum',
            default => $this->classification,
        };
    }

    /**
     * Get the Indonesian label for status
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'draft' => 'Draft',
            'processed' => 'Diproses',
            'archived' => 'Diarsipkan',
            default => $this->status,
        };
    }

    /**
     * Get the badge color class for status
     */
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'draft' => 'bg-gray-200',
            'processed' => 'bg-blue-200',
            'archived' => 'bg-green-200',
            default => 'bg-gray-200',
        };
    }

    /**
     * Get the badge color class for direction
     */
    public function getDirectionBadgeColor(): string
    {
        return match($this->direction) {
            'incoming' => 'bg-green-200',
            'outgoing' => 'bg-orange-200',
            default => 'bg-gray-200',
        };
    }
}
