<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CompanyLegal extends Model
{
    use HasUuids;

    protected $table = 'company_legal';

    protected $fillable = [
        'company_id', 
        'npwp', 
        'nib', 
        'akta_pendirian', 
        'tanggal_pendirian',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}