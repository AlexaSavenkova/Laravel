<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $availableFields = ['id', 'name', 'slug', 'description'];

    public function getCategories(): array
    {
        return DB::table($this->table)
            ->select($this->availableFields)
            ->get()
            ->toArray();
    }

    public function getNewsByCategorySlug($slug) {
        $id = $this->getIdBySlug($slug);
        $fields = ['id', 'title', 'author', 'status', 'description', 'created_at'];
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
}
