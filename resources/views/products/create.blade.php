@extends('layouts.master')

@section('content')
<h1>เพิ่มสินค้า</h1>
<form action="{{ route('products.store') }}" method = 'post' enctype="multipart/form-data">
    @csrf
    <div>
        ชื่อสินค้า : <input type="text" name ='name' class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}"><br>
        @error('name')
        <div class = 'alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <div>
        รายละเอียดสินค้า : <input type="text" name= 'detail' class="form-control @error('detail') is-invalid @enderror" value="{{ old('detail')}}"><br>
        @error('detail')
        <div class = 'alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <div>
        ราคา : <input type="number" name='price' class="form-control @error('price') is-invalid @enderror" value="{{ old('price')}}"><br>
        @error('price')
        <div class = 'alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <div>
        จำนวน : <input type="number" name='count' class="form-control @error('count') is-invalid @enderror" value="{{ old('count')}}"><br>
        @error('count')
        <div class = 'alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <div>
        <input id="file-upload" type="file" name="image" style="margin-bottom: 10px" class = "@error('image') is-invalid @enderror"><br>
        @error('image')
        <div class = 'alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <input type="submit" value = 'ยืนยัน' class="btn btn-primary">
</form>
@endsection
