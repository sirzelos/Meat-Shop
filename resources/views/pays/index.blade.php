@extends('layouts.master')

@section('content')

    <h1>รายการชำระเงินทั้งหมด</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">ดูรายการแจ้งชำระเงินทั้งหมด</li>
        </ol>
    </nav>
    <div class='card'>
        @foreach ($pays as $pay)
            @can ('view', $pay)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ action('PaysController@show', [$pay->id]) }}">Order หมายเลข : {{ $pay->order_id }}</a>
                        </h5>
                        <p>จำนวนเงินที่ชำระ : {{ $pay->price}}</p>
                        <p>ผู้ชำระเงิน : {{ $pay->first_name}} {{ $pay->last_name}}</p>
                        @if (Auth::user()->role == "ADMIN")
                            @endif
                        @foreach ($orders as $order)
                            @if ($order->id === $pay->order_id )
                                @if ($order->status == 'ยังไม่ชำระเงิน' || $order->status == 'ชำระเงินผิดพลาด')
                                    <p class="card-text"> สถานะ : <a class="text-danger"> {{$order->status}}</a></p>
                                @elseif($order->status == 'กำลังตรวจสอบการชำระเงิน')
                                    <p class="card-text"> สถานะ : <a> {{$order->status}}</a></p>
                                @else
                                    <p class="card-text"> สถานะ : <a class="text-success"> {{$order->status}}</a></p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            @endcan
        @endforeach
    </div>
    <div style="margin: 15px; text-align: center">
        @for ($i = 1; $i < ceil($page_count) + 1; $i++)
            <a href="/pays/page/{{$i}}" class="btn btn-primary">{{$i}}</a>
        @endfor
    </div>
@endsection
