<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'message'];
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }
}
