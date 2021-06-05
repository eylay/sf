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

    <div>
        <h2 class="text-center"> لیست کامنت ها </h2>
        <hr>
        @foreach ($shop->comments as $comment)
            <div class="alert alert-info my-2">
                {{$comment->text}}
                <hr>
                {{persianDate($comment->created_at)}}
            </div>
        @endforeach
        <h5 class="my-3"> در صورت تمایل میتوانید کامنت بذارید </h5>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
            <textarea name="text" class="form-control my-2" rows="4" placeholder="متن کامنت"></textarea>
            <div class="text-center">
                <button type="submit" class="btn btn-primary"> تایید </button>
            </div>
        </form>
    </div>

@endsection
