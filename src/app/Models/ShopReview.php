<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopReview extends Model
{
    use HasFactory;
    protected $fillable = ['name','shop_id','user_id','stars','comment',];
}
