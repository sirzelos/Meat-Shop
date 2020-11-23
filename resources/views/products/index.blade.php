@extends('layouts.master')

@section('content')

    <div class="products-container">
        <h2>สินค้า</h2>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">สินค้า</li>
        </ol>
        </nav>
        @foreach ($products as $product)
            <div class="product-img">
            <a href="/products/{{$product->id}}">
                <img class="img" src="img/{{$product->picture}}">
            </a>
            <span>{{$product->name}}<br>{{$product->detail}}</span>
            <p class = "p">กิโลกรัมละ {{$product->unit_price}} บาท</p>
        </div>
        @endforeach
    </div>


@endsection
