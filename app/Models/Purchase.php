<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    protected $fillable = [
        'seller',
        'purchased_at',
        'created_at',
        'updated_at'
    ];
}
