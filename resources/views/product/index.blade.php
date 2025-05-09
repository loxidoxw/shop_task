@extends('layouts.shop')
@section('content')
    <div class="container">
    @foreach ($products as $product)
        <div>{{$product -> name }} - {{$product -> description}}</div>
    @endforeach
    </div>
@endsection
