<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id','total_price', 'purchase_date'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
