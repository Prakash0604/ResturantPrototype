<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderfood extends Model
{
    use HasFactory;
    protected $fillable=['transaction_id','user_id','menu_item_id','quantity','price','total_amount','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->belongsTo(menu_item::class,'menu_item_id','id');
    }
}
