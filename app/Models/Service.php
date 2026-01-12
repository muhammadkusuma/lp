<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Service extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'title',
        'description',
        'price_start',
        'status',
    ];
}