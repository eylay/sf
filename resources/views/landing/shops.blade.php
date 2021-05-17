@extends('layouts.landing')
@section('content')

    <h4> فروشگاه ها </h4>
    <hr>
    @foreach ($shops as $key => $shop)
        <div class="landing-shop-card">
            <h5 class="text-primary"> {{$shop->title}} </h5>
            <p> <b> آدرس : </b> {{$shop->address ?? '-'}} </p>
            <div class="d-flex justify-content-around">
                <span> {{$shop->full_name}} </span>
                <span> {{$shop->telephone}} </span>
                <span> {{persianDate($shop->created_at)}} </span>
            </div>
            <hr>
            <a href="{{route('shop.show', $shop->id)}}" class="btn btn-primary"> رفتن به فروشگاه </a>
        </div>
    @endforeach

    {{$shops->links()}}

@endsection
