@extends('layouts.master')

@section('content')
@can ('view', $order)
<p style="display: none">{{$user = \App\User::findOrFail($order->user_id)}}</p>
<div >
  <div class="card">
    <div class="card-header text-center">
  รายละเอียดรายการสั่งซื้อ
  </div>
  
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/orders">รายการสั่งซื้อ</a></li>
        <li class="breadcrumb-item active" aria-current="page">รายการสั่งซื้อหมายเลข {{ $order->id}}</li>
      </ol>
    </nav>
  <div class="card-body">
    <p class="card-title">Order ID : {{ $order->id}}</p>
    <p class="card-text"> ผู้สั่ง : <a href="{{route('users.show' ,  ['user' => $user->id])}}"> {{$user->username}}</a></p>
    @if ($order->status == 'ยังไม่ชำระเงิน')
      <p class="card-text"> สถานะ : <a class="text-danger"> {{$order->status}}</a></p>
    @elseif ($order->status == 'ชำระเงินผิดพลาด')
      <p class="card-text"> สถานะ : <a class="text-danger"> {{$order->status}}</a></p>
    @elseif($order->status == 'กำลังตรวจสอบการชำระเงิน')
      <p class="card-text"> สถานะ : <a> {{$order->status}}</a></p>
    @else
      <p class="card-text"> สถานะ : <a class="text-success"> {{$order->status}}</a></p>
    @endif

    <p>ที่อยู่จัดส่ง :  {{$address->house_address}} ถนน{{$address->street}} แขวง/ตำบล{{$address->sub_district}} เขต/อำเภอ{{$address->district}} {{$address->province}} {{$address->zip_code}}</p>
  </div>
  <table class="table  table-bordered table-hover ">
    <thead class="thead-dark">
            <tr>
              <th >
                <div class="p-2 px-3 text-uppercase">สินค้า</div>
              </th>
              <th>
                <div class="py-2 text-uppercase">กก.ละ</div>
              </th>
              <th>
                <div class="py-2 text-uppercase">จำนวน(กก.)</div>
              </th>
              <th>
                <div class="py-2 text-uppercase">ราคา</div>
              </th>

            </tr>
          </thead>
          <tbody>

    @foreach ($order_details as $order_detail)
      <p style="display: none">{{$product = \App\Product::withTrashed()->where('id',$order_detail->product_id)->first()}}</p>
    <tbody>
    <tr>
      @if ($order_detail->order_id === $order->id)
        <td><img src="{{ asset('img/'.$product->picture) }}"  width="70" class="img-fluid rounded shadow-sm">  {{$product->name}}</td>
        <td >{{$product->unit_price}}</td>
        <td>{{ $order_detail->weight}}</td>
          <td>{{ $order_detail->price}}</td>

      @endif
    </tr>
    @endforeach
    </table>
</div>
<div class="row">
  <div class="col-sm-8">

  </div>
  <div class="col-sm-4">
    <div class="card">
    <div class="card-header text-center">
    สรุปราคาทั้งหมด
  </div>
<div class="card-body">
        <p class="text-center">ราคาสิงค้าทั้งหมด {{ $order->total_price-50}} บาท</p>
        <p class="text-center">ค่าจัดส่งสินค้า 50 บาท</p>
        <p class="text-center">ราคาสุทธิ {{ $order->total_price}} บาท</p>
        @if(Auth::user()->role == "CUSTOMER")
        <p class="text-center"><a class="float-center btn btn-primary" href="{{ action('PaysController@create') }}" role="button">แจ้งชำระเงิน</a><p>
        @elseif(Auth::user()->role == "ADMIN")
         @if ($order->pay_id == 0)
          <p class="text-center"><a class="float-center btn btn-primary" href="/pays" role="button">ดูการแจ้งชำระเงินทั้งหมด</a><p>
          @else
          <p class="text-center"><a class="float-center btn btn-primary" href="/pays/{{ $order->pay_id}}" role="button">ดูการแจ้งชำระเงิน</a><p>
          @endif
          
        @endif

      </div>
    </div>
  </div>
</div>
</div>









        @endcan


@endsection
