<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tabledata extends Model
{
    use HasFactory;
    protected $fillable=['table_number','seat_capicity','status'];
}
