<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table ='sources';

    public static $availableFields = ['id', 'link', 'description'];

    protected $fillable = [
        'link',
        'description',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
