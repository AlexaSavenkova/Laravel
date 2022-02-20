<?php

declare(strict_types=1);
namespace App\Services;

use App\Contracts\Parser;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\Category;

class ParserService implements Parser
{
    private Document $document;
    private string $link;
    private int $source_id;

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link, int $source_id): Parser
    {
        $this->document = XMLParser::load($link);
        $this->link = $link;
        $this->source_id = $source_id;
        return $this;
    }

    /**
     * @return void
     */
    public function parse(): void
    {

        $data = $this->document->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'image' => ['uses' => 'channel.image.url'],
            'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]'],
        ]);
        // Получить катергоию по `name` или создать её с атрибутами name description и slug
            $category = Category::firstOrCreate(
                ['name' => $data['title']],
                ['description' => 'Все новости на тему: '.$data['title'] ]
            );

        $oldNews = News::where('source_id',$this->source_id)->get();
        foreach ($oldNews as $old){
            $old->delete();
        }
        foreach ($data['news'] as $news){

            $news = $news + ['source_id' => $this->source_id];
            $created = News::create($news);
            if($created) {
                $created->categories()->attach($category);
            }
        }

//        $encode = json_encode($data);
//        $explode = explode('/', $this->link);
//        $parseLink = end($explode);
//        Storage::append('parsing/'. $parseLink , $encode);
    }
}
