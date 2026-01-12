<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_name', // Gunakan ini
        'contact_name', // Atau ini
        'email',
        'phone',
        'address',
    ];
}
