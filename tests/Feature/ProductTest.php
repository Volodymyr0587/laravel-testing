<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_route_return_ok()
    {
        $response = $this->get('/products');
        $response->assertSee("Products index");
        $response->assertStatus(200);
    }

    public function test_product_has_name()
    {
        $product = Product::factory()->create();
        $this->assertNotEmpty($product->name);
    }

    public function test_products_are_empty()
    {
        $response = $this->get('/products');
        $response->assertSee('No Products');
    }

    public function test_products_are_not_empty()
    {
        $product = Product::factory()->create();

        $response = $this->get('/products');

        // $response->assertDontSee('No Products');
        $response->assertSee($product->name);
    }
}
