<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderAvailable()
    {
        $response = $this->get(route('order'));
        $response->assertStatus(200);
        $response->assertSeeText('заказ');
    }

    public function testOrderStore()
    {
        $faker = Factory::create();
        $data = [
            'name' => $faker->realTextBetween(5,20),
            'tel' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'info' => $faker->text(100),
        ];
        $response = $this->post(route('order.store'), $data);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

}
