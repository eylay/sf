<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Cart;

class LandingController extends Controller
{
    public function loadPage($page)
    {
        if (method_exists($this, $page)) {
            return $this->$page();
        }else {
            abort(404);
        }
    }

    public function showShop(Shop $shop)
    {
        $products = Product::where('shop_id', $shop->id)->paginate(9);
        return view('landing.shop', compact('shop', 'products'));
    }

    public function showProduct(Product $product)
    {
        return view('landing.product', compact('product'));
    }

    public function products()
    {
        $products = Product::query();
        if ($p = request('p')) {
            $products = $products->where('title', 'like', "%$p%");
        }
        if ($o = request('o')) {
            if ($o == 1) {
                $products = $products->latest();
            }
            if ($o == 2) {
                $products = $products->orderBy('price', 'ASC');
            }
            if ($o == 3) {
                $products = $products->orderBy('price', 'DESC');
            }
        }
        $products = $products->paginate(9);
        return view('landing.products', compact('products'));
    }

    public function shops()
    {
        $shops = Shop::latest()->paginate(10);
        return view('landing.shops', compact('shops'));
    }

    public function cart()
    {
        $user_id = auth()->id();
        $cart = Cart::where('user_id', $user_id)->where('finished', 0)->first();
        return view('landing.cart', compact('cart'));
    }

}
