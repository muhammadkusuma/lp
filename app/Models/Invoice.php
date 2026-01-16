<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number','client_id','project_id',
        'issue_date','due_date','subtotal','tax','tax_rate','total','status'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(fn ($model) => $model->id = (string) Str::uuid());
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
