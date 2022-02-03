<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    public static $availableFields = ['id', 'name', 'tel', 'email', 'info'];

    protected $fillable = [
        'name',
        'tel',
        'email',
        'info',
    ];
}
