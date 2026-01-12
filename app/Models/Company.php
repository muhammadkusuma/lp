<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // Wajib karena migrasi pakai UUID
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Wajib karena migrasi pakai softDeletes

class Company extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'legal_name',
        'email',
        'phone',
        'website',
        'logo_url',
        'address',
        'description',
    ];
}