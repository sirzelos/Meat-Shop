@extends('layouts.master')


@section('content')
<h1 class="p" style="font-size: 40px ; text-decoration: underline;">วิธีการซื้อสินค้า</h1>
<div class="pay-p" style="margin-left: 20px">
    <p>1. <a href="{{route('register')}}">สมัครสมาชิก</a></p>
    <p>2. เข้าสู่ระบบเลือกสินค้าที่ต้องการลงตะกล้าสินค้า</p>
    <p>3. กดยืนยันหากได้สินค้าที่ต้องการครบแล้ว รายการสั่งซื้อจะอยู่ที่ <a a href="/orders">รายการสั่งซื้อ</a></p>
    <p>4. ชำระเงินตามรายละเอียด "วิธีการชำระเงิน" ด้านล่าง</p>
    <p>5. <a a href="/pays/create">แจ้งชำระเงิน</a> เลือกรายการที่ลูกค้าต้องการพร้อมกรอกรายละเอียดและส่งหลักฐานการชําระเงิน</p>
    <p>6. เมื่อตรวจสอบรายการชำระเงินเรียบร้อยแล้วทางร้านจะจัดส่งสินค้าทันที</p>
</div>
<hr>
<h1 class="p" style="text-decoration: underline;">วิธีการชำระเงิน</h1>
<h3 class="p">1.ชำระผ่านการโอนเงินบัญชีธนาคาร</h3>
<div>
    <div>
        <div class="payment-container">
            <img src="{{asset('img/scb.jpg')}}" class="img-payment">
            <div class="payment-detail">
                <p class="p" style="font-size: 40px">ธนาคารไทยพาณิชย์</p>
                <p class="pay-p">สาขา   : กรุงเทพ</p>
                <p class="pay-p">ชื่อบัญชี  : นาย ภัทรพล พลตะคุ</p>
                <p class="pay-p" style="font-size: 30px">เลขบัญชี : 053-1-98952-6</p>
            </div>
        </div>
    </div>
    <div>
        <div class="payment-container">
            <img src="{{asset('img/krungthai.jpg')}}" class="img-payment">
            <div class="payment-detail">
                <p class="p" style="font-size: 40px">ธนาคารกรุงไทย</p>
                <p class="pay-p">สาขา   : กรุงเทพ</p>
                <p class="pay-p">ชื่อบัญชี  : นาย ภัทรพล พลตะคุ</p>
                <p class="pay-p" style="font-size: 30px">เลขบัญชี : 053-1-98952-8</p>
            </div>
        </div>
    </div>
    <div>
        <div class="payment-container">
            <img src="{{asset('img/bangkok.jpg')}}" class="img-payment">
            <div class="payment-detail">
                <p class="p" style="font-size: 40px">ธนาคารกรุงเทพ</p>
                <p class="pay-p">สาขา   : กรุงเทพ</p>
                <p class="pay-p">ชื่อบัญชี  : นาย ภัทรพล พลตะคุ</p>
                <p class="pay-p" style="font-size: 30px">เลขบัญชี : 053-1-98952-9</p>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
