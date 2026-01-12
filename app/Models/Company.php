<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
