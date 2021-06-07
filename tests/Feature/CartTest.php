<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if user can see cart page
     *
     * @return void
     */
    public function test_if_cart_pages_loads()
    {
        $response = $this->get('landing/cart');

        $response->assertStatus(200);
    }

    /**
     * Test if user can add to cart
     *
     * @return void
     */
    public function test_if_users_can_add_to_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("cart/manage/$product->id", [
            'type' => 'add'
        ]);

        $this->assertCount(1, Cart::all());
        $this->assertCount(1, CartItem::all());
        $response->assertStatus(200);
    }
}
