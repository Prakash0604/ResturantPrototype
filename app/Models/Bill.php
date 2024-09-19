<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'menu_id', 'table_id', 'subtotal', 'tax_amount', 'discount_amount', 'service_charge_amount', 'total_amount'];

    public function billOrderItems()
    {
        return $this->hasMany(BillOrderItem::class, 'bill_id');
    }

    public function order()
{
    return $this->belongsTo(Order::class, 'order_id'); // Assuming `order_id` is the foreign key in bills
}
}
