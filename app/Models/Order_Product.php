<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    use HasFactory;

    protected $table = 'order-product';

    protected $fillable = [
        'id_order',
        'id_product',
        'count',
        'weight',
        'review_text',
        'review_photo',
        'comment_text',
        'comment_photo',
        'created_at',
        'updated_at'
    ];
}
