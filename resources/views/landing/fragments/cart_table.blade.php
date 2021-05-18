<table class="table table-bordered">
    <thead>
        <tr>
            <th> ردیف </th>
            <th> محصول </th>
            <th> فروشگاه </th>
            <th> تعداد </th>
            <th> قابل پرداخت </th>
            @if ($operations)
                <th> حذف </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($cart->items as $key => $item)
            <tr>
                <th> {{$key+1}} </th>
                <td> {{$item->product->title ?? '-'}} </td>
                <td> {{$item->product->shop->title ?? '-'}} </td>
                <td>
                    @if ($operations)
                        <form method="post" action="{{route('cart.manage', $item->product_id)}}">
                            @csrf
                            <button type="submit" name="type" value="minus" class="btn btn-warning text-white btn-sm"> - </button>
                            <span class="cart-count"> {{$item->count}} </span>
                            <button type="submit" name="type" value="add" class="btn btn-warning text-white btn-sm"> + </button>
                        </form>
                    @else
                          {{$item->count}}
                    @endif
                </td>
                <td> {{number_format($item->payable)}} </td>
                @if ($operations)
                    <td>
                        <form class="" action="{{route('cart.remove', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"> حذف </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td colspan="4"> جمع کل </td>
            <td colspan="2"> {{number_format($cart->sum)}} تومان </td>
        </tr>
    </tbody>
</table>
