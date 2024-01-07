<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_new_product()
    {
        $admin = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($admin)->post('/products', [
            'name' => 'Apple',
            'type' => 'Fruit',
            'price' => 2.99,
        ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect('/products');
        $this->assertCount(1, Product::all());
        $this->assertDatabaseHas('products', [
            'name' => 'Apple',
            'type' => 'Fruit',
            'price' => 2.99,
        ]);
    }

    public function test_admin_can_see_the_edit_product_page()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->get('/products/' . $product->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_admin_can_update_product()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        Product::factory()->create();
        $this->assertCount(1, Product::all());
        $product = Product::first();
        $response = $this->actingAs($admin)->put('/products/' . $product->id, [
            'name' => 'Updated Product',
            'type' => 'Updated type',
            'price' => 4.99,
        ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect('/products');
        $this->assertEquals('Updated Product', Product::first()->name);
        $this->assertEquals('Updated type', Product::first()->type);
        $this->assertEquals(4.99, Product::first()->price);
    }

}
