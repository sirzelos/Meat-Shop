@extends('layouts.master')

@section('content')

    @isset($message)
        <script>alert('{{$message}}');</script>
    @endisset
    <div class="products-container">

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        ตะกร้าสินค้า
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="p-2 px-3 text-uppercase">สินค้า</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase">กก.ละ</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase">จำนวน(กก.)</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase">ราคา</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase">In Stock</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($carts as $cart)

                                    <tr class = "bg-light">
                                        <th scope="row" class="border-0">
                                            <p style="display: none">{{$product = \App\Product::findOrFail($cart->product_id)}}</p>
                                            <div class="p-2">
                                                <img src="{{ asset('img/'.$product->picture) }}"  width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"> <a href="{{asset('/products/'.$product->id)}}" class="text-dark d-inline-block align-middle">{{$product->name}}</a></h5>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle text-center"><strong>฿{{number_format($product->unit_price, 0, ',', ',')}}</strong></td>
                                        <td class="border-0 align-middle text-center"><strong>{{$cart->count}}</strong></td>
                                        <td class="border-0 align-middle text-center"><strong>฿{{number_format($cart->total_price, 0, ',', ',')}}</strong></td>
                                        <td class="border-0 align-middle text-center"><strong>{{$product->count}}</strong></td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        ที่อยู่จัดส่ง
                    </div>
                    <form action="{{ asset('/orders') }}" method = 'post' enctype="multipart/form-data">

                        @csrf
                        @isset($address)
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-2 mb-3">
                                        <label>บ้านเลขที่</label>
                                        <input type="text" class="form-control" placeholder="่บ้านเลขที่"  name = 'house_address' value ='{{$address->house_address}}'pattern="[0-9/]{1,}" required>
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
                                        <input type="number" class="form-control"  name = 'zip_code' value ='{{$address->zip_code}}' placeholder="รหัสไปรษณีย์"   min="10000" max="99999" required>
                                        <div class="valid-feedback">
                                            ดีมาก!
                                        </div>
                                        <div class="invalid-feedback">
                                            กรุณาใส่จังหวัด
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
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
                            </div>
                        @endisset


                        @empty($address)
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-2 mb-3">
                                        <label>บ้านเลขที่</label>
                                        <input type="text" class="form-control" placeholder="่บ้านเลขที่"  name = 'house_address'pattern="[0-9/]{1,}" required>
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
                                            <input type="text" class="form-control"  name = 'street' placeholder="ถนน" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์0-9]{1,}" required>
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
                                        <input type="text" class="form-control"  name = 'sub_district' placeholder="ตำบล/แขวง" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์]{1,}"required>
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
                                        <input type="text" class="form-control" name = 'district'  placeholder="อำเภอ/เขต" pattern="[A-Za-zก-ฮะัาำิีึืุูํเแโใไ็่้๊๋์]{1,}"required>
                                        <div class="valid-feedback">
                                            ดีมาก!
                                        </div>
                                        <div class="invalid-feedback">
                                            กรุณาใส่อำเภอ/เขต
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label >รหัสไปรษณีย์</label>
                                        <input type="number" class="form-control"  name = 'zip_code' placeholder="รหัสไปรษณีย์"    min="10000" max="99999"required>
                                        <div class="valid-feedback">
                                            ดีมาก!
                                        </div>
                                        <div class="invalid-feedback">
                                            กรุณาใส่จังหวัด
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>จังหวัด</label>
                                        <select class="custom-select" name = 'province' required>
                                            <option selected>เลือกจังหวัด</option>
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
                            </div>
                    @endempty
                </div>

            </div>

            <div class="col-lg-4"><div class="card">

                    <div class="card-body">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">สรุปข้อมูลคำสั่งซื้อ</div>
                        <div class="p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">ยอดรวมสินค้า ({{ $count }} รายการ)</strong>
                                    <strong>  ฿{{number_format($total_price, 0, ',', ',')}}</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">ค่าจัดส่ง</strong>
                                    <strong>฿50</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">ยอดรวม</strong>
                                    <strong>฿{{number_format($total_price+50, 0, ',', ',')}}</strong>
                                </li>
                            </ul>


                            @if ($in_cart !== 0)
                                <input type="submit" class="btn btn-dark rounded-pill py-2 btn-block" value="ยืนยัน">
                                @endif
                                </form>
                        </div>
                        <form action="{{route('carts.edit')}}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-dark rounded-pill py-2 btn-block" value="แก้ไขรายการสินค้าในตะกร้า">
                        </form>
                    </div>




                </div>

            </div>
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
