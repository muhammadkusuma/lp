<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable  = ['invoice_id', 'payment_date', 'amount', 'method', 'proof_url'];
    protected $keyType   = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn($model) => $model->id = (string) Str::uuid());
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
