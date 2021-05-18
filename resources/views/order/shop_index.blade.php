<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لیست سفارشات
        </h2>
    </x-slot>

    <table>
        <thead>
            <tr>
                <th> ردیف </th>
                <th> مشتری </th>
                <th> محصول </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
                <th> تاریخ </th>
                <th> ساعت </th>
                <th> وضعیت </th>
                <th> تغییروضعیت </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <th> {{$key+1}} </th>
                    <td> {{$item->cart->user->name ?? '-'}} </td>
                    <td> {{$item->product->title ?? '-'}} </td>
                    <td> {{$item->count}} </td>
                    <td> {{number_format($item->payable)}} </td>
                    <td> {{persianDate($item->created_at)}} </td>
                    <td> {{$item->created_at->format('H:i')}} </td>
                    <td>
                        @if ($item->status == 1)
                            <span class="bg-yellow-400 text-white px-4 py-2"> سفارش جدید </span>
                        @elseif ($item->status == 2)
                            <span class="bg-green-400 text-white px-4 py-2"> تحویل داده شده </span>
                        @else
                            <span class="bg-red-400 text-white px-4 py-2"> مرجوع شده </span>
                        @endif
                    </td>
                    <td>
                        <form class="flex" action="{{route('order.status', $item->id)}}" method="post">
                            @csrf
                            <select class="form-control form-control-sm" name="status">
                                <option value=""> --- </option>
                                <option value="1"> سفارش جدید </option>
                                <option value="2"> تحویل داده شده </option>
                                <option value="3"> مرجوع شده </option>
                            </select>
                            <x-jet-button class="mr-4">
                                تایید
                            </x-jet-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{$items->links()}}
    </div>

</x-app-layout>
