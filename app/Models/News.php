<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory, Sluggable;

    protected $table = "news";
    public static $availableFields = ['id', 'title', 'author', 'status','source_id', 'description', 'image', 'created_at'];

    protected $fillable = [
        'title',
        'slug',
        'author',
        'status',
        'description',
        'source_id',
        'link',
        'pubDate',
        'enclosure::url',
        'image',
        'isImage',
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
