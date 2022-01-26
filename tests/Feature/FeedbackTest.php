<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function testFeedbackAvailable()
    {
        $response = $this->get(route('feedback'));
        $response->assertStatus(200);
        $response->assertSeeText('отзыв');
        $response->assertDontSee('заказ');
        $response->assertViewIs('feedback');
    }

    public function testOrderStore()
    {
        $faker = Factory::create();
        $data = [
            'name' => $faker->realTextBetween(5,20),
            'feedback' => $faker->text(100),
        ];
        $response = $this->post(route('feedback.store'), $data);
        $response->assertOk();
        $response->assertViewHasAll(['type'=>'primary','message']);
        $response->assertViewIs('message');
    }
}
