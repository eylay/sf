<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function manage(Product $product, Request $request)
    {
        $type = $request->type; // add, remove
        $currentLoggedInUser = auth()->user();
        if ($currentLoggedInUser) {

            $cart = Cart::firstOrCreate(['user_id' => $currentLoggedInUser->id, 'finished' => 0]);

            if ($cart_item = $product->isInCart()) {
                if ($type == 'add') {
                    $cart_item->count++;
                }else {
                    $cart_item->count--;
                }
                if ($cart_item->count == 0) {
                    $cart_item->delete();
                }else {
                    $cart_item->payable = $cart_item->count * $product->cost;
                    $cart_item->save();
                }
            }else {
                $cart_item = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'count' => 1,
                    'payable' => $product->cost,
                ]);
            }

            return [
                'count' => $cart_item->count,
                'totalCount' => $cart->count,
            ];

        }else {
            return [
                'error' => 'لطفا ابتدا وارد حساب کاربری خود شوید.'
            ];
        }
    }

    public function remove(CartItem $cart_item)
    {
        $cart_item->delete();
        return back()->withMessage('آیتم مورد نظر از سبد خرید شما حذف شد.');
    }

    public function finish()
    {
        $cart = Cart::where('user_id', auth()->id())->where('finished', 0)->first();
        if (!$cart) {
            return back()->withError('سبد خریدی وجود ندارد!');
        }
        $cart->finished = 1;
        $cart->code = rand(100000, 999999);
        $cart->save();
        return back()->withMessage("پرداخت شما با موفقیت در سیستم ثبت شد. کد پیگیری : $cart->code");
    }
}
