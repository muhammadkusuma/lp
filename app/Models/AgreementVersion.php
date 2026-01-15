<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'agreement_id',
        'version_number',
        'file_path',
        'notes',
        'uploaded_by',
    ];

    /**
     * Get the agreement this version belongs to
     */
    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    /**
     * Get the user who uploaded this version
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
