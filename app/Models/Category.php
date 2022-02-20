<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $table = "categories";
    public static $availableFields = ['id', 'name', 'slug', 'description'];

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'categories_has_news',
            'category_id', 'news_id');
    }


    public function getNewsByCategorySlug($slug) {
        $id = $this->getIdBySlug($slug);
        $fields = ['id', 'title', 'author', 'status', 'description','source_id', 'created_at'];
        $news = DB::table('categories_has_news')
            ->select($fields)
            ->where('category_id', '=', $id)
            ->join('news','news_id', '=', 'id')
            ->get()
            ->toArray();
        return $news;
    }

    public function getIdBySlug($slug) {
        $id = DB::table($this->table)
            ->where('slug', '=', $slug)
            ->value('id');
        return $id;
    }

    public function getCategoryNameBySlug($slug)
    {
        $name = DB::table($this->table)
            ->where('slug', '=', $slug)
            ->value('name');

        return $name;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
