<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['table_id'];

    public function table()
    {
        return $this->belongsTo(tabledata::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


}