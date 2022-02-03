<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = "feedback";
    public static $availableFields = ['id', 'name', 'feedback'];

    protected $fillable = [
        'name',
        'feedback',
    ];
}
