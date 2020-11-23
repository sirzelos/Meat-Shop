@extends('layouts.master')

@section('content')


    <div class="products-container">

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-8" style="width: 100%; flex: 0px ; max-width: 100%;">
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
                                        <div class="p-2 px-3 text-uppercase" style="text-align: center">สินค้า</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">กก.ละ</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">จำนวน(กก.)</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">ราคา</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">In Stock (กก.)</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">เพิ่ม/ลด จำนวนสินค้า</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">ลบรายการ</div>
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
                                                    <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$product->name}}</a></h5>
                                                </div>
                                            </div>
                                        </th>
                                        <form action="{{ route('cart.update',['cart' => $cart])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                        <td class="border-0 align-middle text-center"><strong>฿{{$product->unit_price}}</strong></td>
                                        <td class="border-0 align-middle text-center">
                                            <input type="number" value="{{$cart->count}}" name="count" style="width: 50%"  max="99" value="1">
                                        </td>
                                        <td class="border-0 align-middle text-center"><strong>฿{{$cart->total_price}}</strong></td>
                                        <td class="border-0 align-middle text-center"><strong>{{$product->count}}</strong></td>
                                        <td class="border-0 align-middle text-center">
                                            <button type='submit' class="btn btn-primary">แก้ไขจำนวน</button>
                                        </td>
                                        </form>
                                        <td class="border-0 align-middle text-center">
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal{{$cart->product_id}}">
                                            ลบรายการ
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$cart->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ลบรายการ <a class="text-primary">{{$product->name}}</a></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ลูกค้าต้องการยกเลิกสินค้า <a class="text-primary">{{$product->name}}</a> ใช่หรือไม่?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('cart.destroy',['cart' => $cart->id])}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type='submit' class="btn btn-danger">ใช่</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
