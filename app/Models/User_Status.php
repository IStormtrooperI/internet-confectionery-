<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Status extends Model
{
    use HasFactory;

    protected $table = 'user_status';

    protected $fillable = [
        'name',
        'percent',
        'toAchieveThat',
        'created_at',
        'updated_at'
    ];
}
