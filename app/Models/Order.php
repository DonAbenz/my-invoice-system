<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'customer_name',
    ];

    public $incrementing = false;
    protected $primaryKey = 'code';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_code');
    }
}
