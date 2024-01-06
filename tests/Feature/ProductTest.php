<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    public function setup(): void
    {
        parent::setup();

        $this->product = Product::factory()->create();
    }

    public function test_products_route_return_ok()
    {
        $response = $this->get('/products');
        $response->assertSee("Products index");
        $response->assertStatus(200);
    }

    public function test_product_has_name()
    {
        $this->assertNotEmpty($this->product->name);
    }

    // public function test_products_are_empty()
    // {
    //     $response = $this->get('/products');
    //     $response->assertSee('No Products');
    // }

    public function test_products_are_not_empty()
    {
        $response = $this->get('/products');

        $response->assertSee($this->product->name);
    }

    public function test_auth_user_can_see_the_buy_product_button()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/products');

        $response->assertSee('Buy Product');
    }

    public function test_unauth_user_cannot_see_the_buy_product_button()
    {
        $response = $this->get('/products');

        $response->assertDontSee('Buy Product');
    }
}
