@extends('layouts.master')

@section('content')
<div class = "container">
  <h1>แก้ไขที่อยู่</h1>
<form action="{{route('addresses.update', ['id' => $address->id])}}" method="post">
  @csrf

<input type="hidden"  name="type" >
  <div class="form-row">
    <div class="col-md-2 mb-3">
      <label>บ้านเลขที่</label>
      <input type="text" class="form-control" placeholder="่บ้านเลขที่"  name = 'house_address' value ='{{$address->house_address}}'pattern="[0-9/-]{1,}" required>
      <div class="valid-feedback">
        ดีมาก!
      </div>
      <div class="invalid-feedback">
        กรุณาใส่บ้านเลขที่!
      </div>
    </div>

    <div class="col-md-5 mb-3">
      <label>ถนน</label>
      <div class="input-group">
        <input type="text" class="form-control"  name = 'street' value ='{{$address->street}}' placeholder="ถนน" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์0-9]{1,}" required>
        <div class="valid-feedback">
          ดีมาก!
        </div>
        <div class="invalid-feedback">
        กรุณาใส่ชื่อถนน!
        </div>
      </div>
    </div>
    <div class="col-md-5 mb-3">
      <label >ตำบล/แขวง</label>
      <input type="text" class="form-control"  name = 'sub_district' value ='{{$address->sub_district}}' placeholder="ตำบล/แขวง" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์]{1,}"required>
      <div class="valid-feedback">
        ดีมาก!
      </div>
      <div class="invalid-feedback">
        กรุณาใส่ตำบล/แขวง
      </div>
    </div>
  </div>
  <div class="form-row">

    <div class="col-md-4 mb-3">
      <label>อำเภอ/เขต</label>
      <input type="text" class="form-control" name = 'district'value ='{{$address->district}}'  placeholder="อำเภอ/เขต" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์]{1,}"required>
      <div class="valid-feedback">
        ดีมาก!
      </div>
      <div class="invalid-feedback">
        กรุณาใส่อำเภอ/เขต
      </div>
    </div>
    <div class="col-md-2 mb-3">
      <label >รหัสไปรษณีย์</label>
      <input type="number" class="form-control"  name = 'zip_code' value ='{{$address->zip_code}}' placeholder="รหัสไปรษณีย์"  min="10000" max="99999" required>
      <div class="valid-feedback">
        ดีมาก!
      </div>
      <div class="invalid-feedback">
        กรุณาใส่จังหวัด
      </div>
    </div>
    <div class="col-md-2 mb-3">
      <label>จังหวัด</label>
        <select class="custom-select" name = 'province' value ='{{$address->province}}' required>
        <option selected>{{$address->province}}</option>
        <option >กรุงเทพมหานคร</option>
        <option >นนทบุรี</option>
        <option >ปทุมธานี</option>
  </select>
      <div class="valid-feedback">
        ดีมาก!
      </div>
      <div class="invalid-feedback">
        กรุณาใส่จังหวัด
      </div>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">ยืนยัน</button>
</form>
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
@endsection
