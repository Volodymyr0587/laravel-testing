<?php

namespace Tests\Unit;

use App\Cart;
use App\Convert;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function test_cart_contents()
    {
        $cart = new Cart(['Apple']);
        $this->assertTrue($cart->has('Apple'));
        $this->assertFalse($cart->has('Ball'));
    }

    public function test_take_one_from_cart()
    {
        $cart = new Cart(['Apple']);
        $this->assertEquals('Apple', $cart->takeOne());
        $this->assertNull($cart->takeOne());
    }

    public function test_price_in_usd()
    {
        $price = new Convert(100);
        $this->assertEquals(3794, $price->priceInUsd());
        $this->assertEquals(4827, $price->priceInGbp());
        $this->assertEquals(2841, $price->priceInCad());
    }
}
