@extends('layouts.master')

@section('content')
<div class="card text-center">


  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">รายงานยอดขายสินค้า</li>
        </ol>
    </nav>
    <form action="{{url('/report/search')}}" method="POST">
          @csrf
่<p class = "text-left"> ค้นหารายงานยอดขายสินค้าระหว่างวันที่ <input type="date" name="from" min="2019-01-01" max="2019-11-29"> ถึงวันที่ <input min="2019-01-01" max="2019-11-29"type="date" name="to"><button  type="submit" class="btn btn-primary">ค้นหา</button></p>
</form>
    <div class="card-body "id="printableArea">

    </span>
      <div class="card-header">
          <h2><p class = "text-center">รายงานยอดขายสินค้า</p></h2>
      </div>
      <table class="table  table-bordered table-hover ">
        <thead class="thead-dark">
          <tr>
            <th>รายการสินค้า</th>
            <th>กิโลกรัมละ(บาท)</th>
            <th>ขายได้จำนวน(กิโลกรัม)</th>
            <th>ยอดขาย(บาท)</th>

            </th>

          </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
          <tr>
    <td>{{$product->name}}</td>
      <td>{{$product->unit_price}}</td>
    <td>{{$product->sales}}</td>
    <td>{{number_format(($product->sales)*($product->unit_price), 0, ',', ',')}}</td>

  </tr>

    @endforeach


        </tbody>

      </table>
      <p class = "text-right">รวมยอดขายทั้งหมด {{number_format($total, 0, ',', ',')}} บาท</p>



    </div>
    <p class = "text-right"><input type="button" onclick="printDiv('printableArea')" class="btn btn-primary" value="print" /></p>
    </div>


@endsection
<script>
function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
}
</script>
<script>
	// Date picker only
	$('#datepicker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
</script>
