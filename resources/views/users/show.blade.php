@extends('layouts.master')
@section('content')

<div class="row no-gutters ">
  <div class="col-md-4 border-dark">
    <img src='../img/profile/{{$user->picture }}'width="350" height="360" class="card-img" >
  </div>
  <div class="col-md-4 border border-dark">
    <h5 class="card-header">Profile</h5>
    <div class="card-body ">
      <p class="card-text">Username  : {{ $user->username }}</p>
      <p class="card-text">Firstname : {{ $user->first_name }}</p>
      <p class="card-text">Lastname  : {{ $user->last_name }}</p>
      <p class="card-text">Email      : {{ $user->email }}</p>
      <p class="card-text"><small class="text-muted">อัพเดตล่าสุด : {{ $user->updated_at }}</small></p>
        </div>
    </div>
    <div class="col-md-4 border border-dark">
  @isset($address)
<h5 class="card-header">ที่อยู่</h5>
                <div class="card-body">
                  <p class="card-text">บ้านเลขที่  :   {{$address->house_address}}</p>
                  <p class="card-text">ถนน  : {{$address->street}}</p>
                  <p class="card-text">แขวง/ตำบล  : {{$address->sub_district}}</p>
                  <p class="card-text">เขต/อำเภอ  :{{$address->district}}</p>
                  <p class="card-text">จังหวัด  :  {{$address->province}}</p>
                  <p class="card-text">รหัสไปรษณีย์  :  {{$address->zip_code}}</p>
  <p class="card-text"><small class="text-muted">อัพเดตล่าสุด : {{$address->created_at}}</small></p>


                </div>

              @endisset
              @empty($address)
              <h5 class="card-header">ที่อยู่</h5>

              @endempty
    </div>
  </div>
  <div class="card">
    <div class="card-header">
    รายการสั่งซื้อของลูกค้า
    </div>
    <div class="card-body">
      <table class="table  table-bordered table-hover ">
        <thead class="thead-dark">
          <tr>
            <th>วันที่สั่ง</th>
            <th>รหัสorder</th>
            <th>ราคา</th>
            <th>สถานะ</th>
            <th>ดูรายละเอียด</th>
            <th>ผู้สั่ง</th>  @if(Auth::user()->role == "ADMIN")
                <th>อัพเดตสถานะ</th>

            <th >ยกเลิก</div>
            </th>
            @endif
          </tr>
        </thead>
        @foreach ($orders as $order)

        <tbody>
            <p style="display: none">{{$user = \App\User::findOrFail($order->user_id)}}</p>
          <tr>
            <td>{{ $order->created_at}}</td>
            <td>{{ $order->id}}</td>
            <td>{{ $order->total_price}}</td>
            @if ($order->status == 'ยังไม่ชำระเงิน')
              <td class="text-danger"> {{$order->status}}</td>
            @elseif($order->status == 'จัดส่งเรียบร้อย')
              <td class="text-success"> {{$order->status}}</td>
            @else
            <td text-primary> {{$order->status}}</td>
            @endif
            <td><a href="{{ action('OrdersController@show', [$order->id]) }}">ดูรายละเอียดการสั่งซื้อ</a></td>
            <td><a href="{{route('users.show' ,  ['user' => $user->id])}}"> {{$user->username}}</a></td>
            <td><a class="btn btn-primary" href="{{ action('OrdersController@edit', [$order->id]) }}" role="button">อัพเดทสถานะ</a></td>
            <td class="border-0 align-middle text-center">
              <form method = "post" action ="{{route('orders.destroy' , ['order'=>$order->id])}}" >
                @csrf
                <input type="hidden" name="_method" value="DELETE">
               <button type="submit" class="btn btn-danger ">Delete</button>
            </form>
      </td>



          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
