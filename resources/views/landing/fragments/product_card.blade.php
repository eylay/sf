<div class="col-md-4 my-3 product-card">
    <div class="d-flex justify-content-between">
        <h5> <a href="{{route('product.show', $product->id)}}"> {{$product->title}} </a> </h5>
        <p>
            @if ($product->discount)
                <span class="text-danger off mx-2"> {{number_format($product->price)}} </span>
            @endif
            <span> {{number_format($product->cost)}} </span>
        </p>
    </div>
    <hr>
    <img src="{{asset($product->image ?? 'img/empty.jpg')}}">
    <p class="mt-3">
        @if ($product->description)
            {{$product->description}}
        @else
            <em> بدون توضیحات ... </em>
        @endif
    </p>
    <hr>
    <form class="d-flex justify-content-between align-items-center" method="post" action="{{route('cart.manage', $product->id)}}">
        <a href="#"> {{$product->shop->title ?? '-'}} </a>
        <div class="in-cart @unless($cart_item = $product->isInCart()) hidden @endunless" >
            <button type="button" name="type" value="minus" class="btn btn-warning text-white btn-sm manage-cart"> - </button>
            <span class="cart-count"> {{$cart_item->count ?? 0}} </span>
            <button type="button" name="type" value="add" class="btn btn-warning text-white btn-sm manage-cart"> + </button>
        </div>
        <div class="not-in-cart @if($product->isInCart()) hidden @endif">
            <button type="button" name="type" value="add" class="btn btn-info text-white px-3 btn-sm manage-cart"> اضافه کردن به سبد خرید </button>
        </div>
    </form>
    <div class="hidden alert alert-danger mt-2">

    </div>
</div>
