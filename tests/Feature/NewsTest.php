<?php

namespace Tests\Feature;

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
        $id = mt_rand(1,10);
        $response = $this->get(route('news.show', ['id' => $id]));
        $response->assertStatus(200);
        $this->assertEquals($id, $response['news']['id']);
    }
}
