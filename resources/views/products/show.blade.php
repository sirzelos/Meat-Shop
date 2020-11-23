@extends('layouts.master')

@section('content')
    <div class="products-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/products">สินค้า</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name}}</li>
      </ol>
    </nav>
        <div>
            <a href="#">
                <img class="img" src='../img/{{$product->picture}}'>
            </a>
        </div>
        <div class = "detail-container">
            <h3>{{ $product->name }}</h3><hr>
            <p>{{ $product->detail }}</p>
            <p style="float: left;width: 50%;" class = "p-detail">กิโลกรัมละ {{ $product->unit_price }} บาท</p>
            <p style="float: right ; width: 50% ;text-align: right" class = "p-detail">In Stock : {{$product->count}}</p>
            @if (Gate::allows('add-cart',\App\Cart::class))
                <form action="{{ route('cart.store') }}" method = 'post' style="float: left;width: 100%">
                    @csrf
                    จำนวน : <input type="number" name="count" min="1" max="{{$product->count}}" value="1" > กิโลกรัม
                    <input type="hidden" value="{{$product->id}}" name="pid">
                    <button class="btn btn-primary" type="submit" style="float: right" >Add to Cart</button>
                </form>
            @endif
        </div>
        @can('delete',$product)
            <td class="border-0 align-middle text-center">
                <button type="button" class="btn btn-outline-danger" style="float:right;" data-toggle="modal" data-target="#exampleModal">DELETE</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ลบ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span  style = "height:100%;padding:0;"  aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>คุณต้องการลบรายการสั่งซื้อใช่ไหม</p>
                            </div>
                            <div class="modal-footer">
                                <form method = "post" action ="" >
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger ">ลบ</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        <form action="{{ route('products.destroy',['product'=>$product->id]) }}" method = 'post'>
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$product->id}}" name="pid">
        </form>
            @endcan
    </div>
@endsection
