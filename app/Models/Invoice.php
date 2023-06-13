<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes;
    
    protected $fillable = [
        'code',
        'customer_name',
    ];

    public $incrementing = false;
    protected $primaryKey = 'code';

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_code');
    }
}
