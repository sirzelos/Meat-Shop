@extends('layouts.master')

@section('content')


    <div class="products-container">

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-8" style="width: 100%; flex: 0px ; max-width: 100%;">
                <div class="card">
                    <div class="card-header">
                        เพิ่มสินค้าในคลัง
                    </div>
                    <div class="card-body">

                            <table class="table  table-bordered table-hover ">
                                <thead class="thead-dark">
                                <tr >
                                    <td class=" bg-secondary">
                                        <div class="p-2 px-3 text-uppercase" style="text-align: center">สินค้า</div>
                                    </td>

                                    <td class=" bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center">In Stock (กก.)</div>
                                    </td>
                                    <td class=" bg-secondary">
                                        <div class="py-2 text-uppercase" style="text-align: center"></div>
                                    </td>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($products as $product)

                                    <tr >
                                        <td scope="row" >
                                            <div class="p-2">
                                                <img src="{{ asset('img/'.$product->picture) }}"  width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$product->name}}</a></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <form action="{{ route('products.update',['product' => $product])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <input type="number" value="{{$product->count}}" name="count" style="width: 30%"  min="0" max="9999">
                                            </td>
                                        <td>

                                            <button type='submit' class="btn btn-primary">บันทึก</button>
                                        </td>
                                        </form>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>


            </div>
        </div>
@endsection
