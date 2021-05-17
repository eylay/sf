@extends('layouts.landing')
@section('content')

    <h4 class="text-center"> محصولات </h4>
    <hr>
    <form class="row justify-content-center align-items-center" method="get">
        <div class="col-md-4 from-group">
            <label class="mb-2"> نام محصول </label>
            <input type="text" name="p" class="form-control" value="{{request('p')}}">
        </div>
        <div class="col-md-4 from-group">
            <label class="mb-2">مرتب سازی بر حسب</label>
            <select class="form-control" name="o">
                <option value=""> -- انتخاب کنید -- </option>
                <option value="1" @if(request('o') == 1) selected @endif> جدیدترین </option>
                <option value="2" @if(request('o') == 2) selected @endif> ارزانترین </option>
                <option value="3" @if(request('o') == 3) selected @endif> گرانترین </option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"> جستجو </button>
        </div>
    </form>
    <hr>
    <div class="row">
        @foreach ($products as $product)
            @include('landing.fragments.product_card')
        @endforeach
    </div>

    <hr>

    {{$products->links()}}

@endsection
