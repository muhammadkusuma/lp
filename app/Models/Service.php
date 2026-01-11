<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable  = ['title', 'description', 'price_start', 'status'];
    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }

    public function packages()
    {
        return $this->hasMany(ServicePackage::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
