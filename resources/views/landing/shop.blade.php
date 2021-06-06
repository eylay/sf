@extends('layouts.landing')
@section('content')

    <h4> {{$shop->title}} </h4>
    <hr>
    <div class="row">
        @foreach ($products as $product)
            @include('landing.fragments.product_card')
        @endforeach
    </div>
    <hr>
    {{$products->links()}}
    @include('landing.fragments.comments', ['list' => $shop->comments, 'owner_type' => 'Shop', 'owener_id' => $shop->id])

@endsection
