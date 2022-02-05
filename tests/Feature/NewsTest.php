<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $source = Source::factory()->create();
        $news = News::factory()
            ->for($source)
            ->create();

        $response = $this->get(route('news.show', ['news' => $news]));
        $response->assertStatus(200);
    }
}
