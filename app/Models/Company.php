<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'legal_name', 'logo_url', 'address', 'phone', 'email', 'website', 'description',
    ];

    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }

    public function legal()
    {
        return $this->hasOne(CompanyLegal::class);
    }
}
