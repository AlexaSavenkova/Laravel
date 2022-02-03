<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    public static $availableFields = ['id', 'title', 'author', 'status','source_id', 'description', 'created_at'];

    protected $fillable = [
        'title',
        'slug',
        'author',
        'status',
        'description',
        'source_id',
    ];
//    protected $guarded = [
//        'id',
//    ];

    protected $casts = [
        'isImage' => 'boolean'
    ];

    public function getTitleAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_has_news',
        'news_id', 'category_id');
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
