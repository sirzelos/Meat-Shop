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
่<p class = "text-left"> ค้นหารายงานยอดขายสินค้าตั้งแต่วันที่<input type="date" name="from" min="2019-01-01" max="2019-11-29" required>ถึงวันที่<input min="2019-01-01" max="2019-11-29"type="date" name="to" required><button  type="submit" class="btn btn-primary">ค้นหา</button></p>
</form>
    <div class="card-body "id="printableArea">

    </span>
      <div class="card-header">
          <h2><p class = "text-center">รายงานยอดขายสินค้า</p></h2>
          <p class = "text-right">รายงานยอดขายสินค้าตั้งแต่ <a class="text-danger">{{$form}}</a> ถึง <a class="text-danger">{{$to}}</a></p>
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

          <tr>
<td>Round Beef (เนื้อส่วนสะโพก)</td>

    <td>250บาท</td>
        <td>{{$weight1}}</td>
        <td>{{number_format($weight1*230, 0, ',', ',')}}</td>

  </tr>
  <tr>
<td>Chuck Beef (เนื้อสันคอ)</td>

<td>230บาท</td>
<td>{{$weight2}}</td>
<td>{{number_format($weight2*230, 0, ',', ',')}}</td>

</tr>
<tr>
<td>Rib Beef (เนื้อซี่โครง)</td>

<td>250บาท</td>
<td>{{$weight3}}</td>
<td>{{number_format($weight3*250, 0, ',', ',')}}</td>

</tr>
<tr>
<td>Sirloin Beef (เนื้อเซอร์ลอยด์)</td>

<td>240บาท</td>
<td>{{$weight4}}</td>
<td>{{number_format($weight4*240, 0, ',', ',')}}</td>

</tr>
<tr>
<td>Tenderloin Beef (เนื้อสันใน)</td>

<td>380บาท</td>
<td>{{$weight5}}</td>
<td>{{number_format($weight5*380, 0, ',', ',')}}</td>

</tr>
<tr>
<td>Shank Beef (เนื้อน่อง)</td>

<td>230บาท</td>
<td>{{$weight6}}</td>
<td>{{number_format($weight6*230, 0, ',', ',')}}</td>

</tr>




        </tbody>

      </table>
      <p class = "text-right">รวมยอดขายทั้งหมด {{number_format($total*230, 0, ',', ',')}} บาท</p>



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
