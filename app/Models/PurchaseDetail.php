<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'ingredient_id', 'quantity', 'price'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
