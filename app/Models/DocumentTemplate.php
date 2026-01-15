<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'file_path',
        'status',
    ];

    /**
     * Get the Indonesian label for template type
     */
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'surat_resmi' => 'Surat Resmi',
            'perjanjian_kontrak' => 'Perjanjian & Kontrak',
            'memo_internal' => 'Memo Internal',
            'dokumen_legal' => 'Dokumen Legal',
            default => $this->type,
        };
    }
}
