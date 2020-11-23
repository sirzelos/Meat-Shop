@extends('layouts.master')

@section('content')



<div class="card">
  <p class = "text-center">
  <div class="card-header">
    อัพเดตสถานะ
  </div>
</p>
  <div class="card-body">
    <form action="{{'/orders/' . $order->id}}" method="POST">
    @method('PUT')
    @csrf
    @can ('update', $order)
    <input type="hidden" value="{{$order->id}}" name = "id">
    <p style="display: none">{{$user = \App\User::findOrFail($order->user_id)}}</p>
    <p>Order ID : <a href="{{ action('OrdersController@show', [$order->id]) }}">{{$order->id}}</a></p>
    <p>ผู้สั่ง : {{$user->username}}</a></p>
    <p>วันที่สั่ง : {{$order->created_at}}</a></p>
    <p>แก้ไขล่าสุด : {{$order->updated_at}}</a></p>
    <div class="input-group mb-3">
        <label for="status">อัพเดตถานะ : </label>
      <select class="custom-select" id="inputGroupSelect02" name='status'>
        <option selected>{{ $order->status}}</option>
        @if ($order->status == "ยังไม่ชำระเงิน" || $order->status == "ชำระเงินผิดพลาด" || $order->status == "จัดส่งเรียบร้อย")
        @elseif ($order->status == "กำลังตรวจสอบการชำระเงิน")
        <option >ชำระเงินผิดพลาด</option>
        <option >ชำระเงินถูกต้องกำลังเตรียมส่ง</option>
        @elseif ($order->status == "ชำระเงินถูกต้องกำลังเตรียมส่ง")
        <option >จัดส่งเรียบร้อย</option>
        @endif
      </select>
      <div class="input-group-append">
         <button class="btn btn-outline-secondary" type="submit">อัพเดต</button>
       </div>
    </div>
    </form>
    @endcan
  </div>
</div>
@endsection
