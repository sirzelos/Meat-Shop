@extends('layouts.master')

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/slide1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="products-container">
        <h2>สินค้าขายดี</h2>
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
