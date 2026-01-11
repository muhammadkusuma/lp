<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyLegal extends Model
{
    protected $table = 'company_legal';

    protected $fillable = [
        'company_id', 'npwp', 'nib', 'akta_pendirian', 'tanggal_pendirian',
    ];

    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
