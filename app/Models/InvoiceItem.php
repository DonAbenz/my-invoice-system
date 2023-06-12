<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code',
        'product_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Invoice::class, 'invoice_code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
