<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لیست سفارشات
        </h2>
    </x-slot>

    @if ($orders->count())

        <table>
            <thead>
                <tr>
                    <th> ردیف </th>
                    <th> کاربر </th>
                    <th> وضعیت </th>
                    <th> کدپیگیری </th>
                    <th> تاریخ </th>
                    <th colspan="2"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <th> {{$key+1}} </th>
                        <td> {{$order->user->name ?? '-'}} </td>
                        <td>
                            @if ($order->finished)
                                <span class="text-green-600"> پرداخت شده </span>
                            @else
                                <span class="text-red-600"> تکمیل نشده </span>
                            @endif
                        </td>
                        <td> {{$order->code ?? '-'}} </td>
                        <td> {{persianDate($order->created_at)}} </td>
                        <td>
                            <a href="{{route('order.show', $order->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                جزییات
                            </a>
                        </td>
                        <td>
                            <button type="button" class="delete-record inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{$orders->links()}}
        </div>

    @endif

</x-app-layout>
