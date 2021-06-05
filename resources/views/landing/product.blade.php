@extends('layouts.landing')
@section('content')
    ...
    <hr>
    <h5 class="my-3"> در صورت تمایل میتوانید کامنت بذارید </h5>
    <form action="{{route('comment.store')}}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <textarea name="text" class="form-control my-2" rows="4" placeholder="متن کامنت"></textarea>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"> تایید </button>
        </div>
    </form>
@endsection
