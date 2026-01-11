<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServicePackage extends Model
{
    protected $fillable  = ['service_id', 'name', 'price', 'features'];
    protected $casts     = ['features' => 'array'];
    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
