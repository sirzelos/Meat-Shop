@extends('layouts.master')

@section('content')
@isset($message)
    <script>alert('{{$message}}');</script>
@endisset

<div class="card text-center">
  <div class="card-header">
    <h2>รายชื่อลูกค้า</h2>
  </div>
  <div class="card-body">
    <table class="table  table-bordered table-hover ">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">ชื่อ</th>
          <th scope="col">นามสกุล</th>
          <th scope="col">อีเมลล์</th>
          <th scope="col">เวลาลงทะเบียน</th>
          <th scope="col">ประวัติ</th>
          <th scope="col">ลบ</th>
        </tr>
      </thead>
          @foreach ($users as $user)
          <tbody>
                  <th scope="row">{{$user->id}}</th>
                     <td>{{$user->first_name}}</td>
                     <td>{{$user->last_name}}</td>
                     <td>{{$user->email}}</td>
                     <td>{{$user->created_at}}</td>

                     <td>
                        <a href="{{route('users.show' ,  ['user' => $user->id])}}">ดู</a>
                     </td>
                     <td>

                                <form onsubmit="return confirm('คุณต้องการลบลูกค้าคนนี้ใช่ไหม!');"method = "post" action ="{{route('users.destroy' , ['user'=>$user->id])}}" >
                                  @csrf
                                  @method('DELETE')
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button   onsubmit="geek()" type="submit" class="btn btn-danger">ลบ</button>
                                </form>


                     </td>
          </tr>
                  @endforeach
                </tbody>
    </table>
  </div>
</div>
<div style="margin: 15px; text-align: center">
    @for ($i = 1; $i < ceil($page_count) + 1; $i++)
        <a href="/users/page/{{$i}}" class="btn btn-primary">{{$i}}</a>
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
</script> <script type="text/javascript">
    var ctext = 'Confirm you want to Delete ? \n'
    var permissiontext = document.getElementsByName('permissionname');

    console.log(ctext);
    console.log(permissiontext);
    function ConfirmDelete(){

        return confirm(ctext);
        };

</script>
@endsection
