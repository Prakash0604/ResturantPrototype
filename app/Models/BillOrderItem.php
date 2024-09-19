<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOrderItem extends Model
{
    use HasFactory;
    protected $fillable=['bill_id','order_id','menu_id','price'];
    protected $table="bill_order_items";
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Define the relationship with MenuItem
    public function menuItem()
    {
        return $this->belongsTo(menu_item::class, 'menu_id');
    }
}
