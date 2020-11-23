@extends('layouts.master')

@section('content')

@isset($message)
    <script>alert('{{$message}}');</script>
@endisset

<div class="card text-center">

  <div class="card-header">
      <h2>รายการสั่งซื้อ {{$status}}</h2>
  </div>
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">รายการสั่งซื้อ {{$status}}</li>
        </ol>
    </nav>
  <form action="{{url('/orders/search/1')}}" method="POST">
      @csrf
    <div class="input-group col-md-4">
    สถานะ : <select class="custom-select" id="inputGroupSelect04" name = "select"aria-label="Example select with button addon">
        <option selected> {{$status}}</option>
          <option value="ทั้งหมด">ทั้งหมด</option>
        <option value="ยังไม่ชำระเงิน">ยังไม่ชำระเงิน</option>
        <option value="กำลังตรวจสอบการชำระเงิน">กำลังตรวจสอบการชำระเงิน</option>
        <option value="ชำระเงินผิดพลาด">ชำระเงินผิดพลาด</option>
        <option value="ชำระเงินถูกต้องกำลังเตรียมส่ง">ชำระเงินถูกต้องกำลังเตรียมส่ง</option>
        <option value="จัดส่งเรียบร้อย">จัดส่งเรียบร้อย</option>
      </select>
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">ค้นหา</button>
      </div>
    </div>
</form>
    <div class="card-body">
      <table class="table  table-bordered table-hover ">
        <thead class="thead-dark">
          <tr>
            <th>วันที่สั่ง</th>
            <th>รหัสorder</th>

            <th>ราคา</th>
            <th>สถานะ</th>
            <th>ดูรายละเอียด</th>
            <th>ผู้สั่ง</th>
            @if(Auth::user()->role == "ADMIN")
              <th>อัพเดตสถานะ</th>
            @endif
            <th >ยกเลิก</div>
            </th>

          </tr>
        </thead>
        @foreach ($orders as $order)
        @can ('view', $order)
        <tbody>
            <p style="display: none">{{$user = \App\User::findOrFail($order->user_id)}}</p>
          <tr>
    <td>{{ $order->created_at}}</td>
            <td>{{ $order->id}}</td>

            <td>{{ $order->total_price}}</td>
            @if ($order->status == 'ยังไม่ชำระเงิน')
              <td class="text-danger"> {{$order->status}}</td>
            @elseif($order->status == 'กำลังตรวจสอบการชำระเงิน')
              <td > {{$order->status}}</td>
            @elseif($order->status == 'ชำระเงินผิดพลาด')
              <td class="text-danger"> {{$order->status}}</td>
            @else
              <td class="text-success"> {{$order->status}}</td>
            @endif
            <td><a href="{{ action('OrdersController@show', [$order->id]) }}">ดูรายละเอียดการสั่งซื้อ</a></td>
            <td><a href="{{route('users.show' ,  ['user' => $user->id])}}"> {{$user->username}}</a></td>

            @can ('update', $order)
              <td><a class="btn btn-primary" href="{{ action('OrdersController@edit', [$order->id]) }}" role="button">อัพเดทสถานะ</a></td>
            @endcan
            @if(Auth::user()->role == "CUSTOMER")

            @if ($order->status == 'ยังไม่ชำระเงิน' || $order->status == 'ชำระเงินผิดพลาด' )
              <td >
                        <form  onsubmit="return confirm('คุณต้องการลบคำสั่งซื้อนี้ใช่ไหม!');" method = "post" action ="{{route('orders.destroy' , ['order'=>$order->id])}}" >
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger ">ลบ</button>
                      </form>

              </td>
              @else
                <td class="border-0 align-middle text-center">
                  <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModal" disabled>ลบ</button>
                </td>

            @endif
          @endif
          @if(Auth::user()->role == "ADMIN")
          <td >
              @if ($order->status == 'ยังไม่ชำระเงิน' || $order->status == 'ชำระเงินผิดพลาด' )
                    <form  onsubmit="return confirm('คุณต้องการลบคำสั่งซื้อนี้ใช่ไหม!');" method = "post" action ="{{route('orders.destroy' , ['order'=>$order->id])}}" >
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger ">ลบ</button>
                    </form>
              @endif

            </td>
          @endif
          </tr>
          @endcan
          @endforeach
        </tbody>
      </table>
              @for ($i = 1; $i < ceil($page_count) + 1; $i++)
                  <a href="/orders/page/{{$i}}" class="btn btn-primary">{{$i}}</a>
              @endfor
    </div>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
    <script type="text/javascript">
        var ctext = 'Confirm you want to Delete ? \n'
        var permissiontext = document.getElementsByName('permissionname');

        console.log(ctext);
        console.log(permissiontext);
        function ConfirmDelete(){

            return confirm(ctext);
            };

    </script>

@endsection
