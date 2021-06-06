@extends('layouts.landing')
@section('content')
    ...
    @include('landing.fragments.comments', ['list' => $product->comments, 'owner_type' => 'Product', 'owener_id' => $product->id])
@endsection
