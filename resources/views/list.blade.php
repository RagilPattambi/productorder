@extends('layout')


@section('content')
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #33001a;
}

.topnav a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  border-bottom: 3px solid transparent;
}

.topnav a:hover {
  border-bottom: 3px solid red;
}

.topnav a.active {
  border-bottom: 3px solid red;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
<div class="topnav">
  <a class="active" href="{{ url('/')}}">Home</a>
</div>
<div style="padding-left:16px"><br>
<h2>Product Management</h2>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<table>
  <tr>
    <th>Sl No.</th>
    <th>Product name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Image</th>
    <th>Actions</th>
  </tr>
  @if($product->count() > 0)
  <?php $i=1; ?>
  @foreach($product as $value)
  <tr>
    <td> {{ $i++ }}</td>
    <td>{{ $value->product_name ? $value->product_name : '--' }}</td>
    <td>{{ $value->category_id=="1" ? 'Television' : 'Headphone' }}</td>
    <td>{{ $value->price ? $value->price : '--' }}</td>
    <td><img src="/images/{{$value->image}}" alt="test" class="img-thumbnail" width="50" height="50"></td>
    <td>
        <a href="{{ route('product.edit',$value->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
        <input type="hidden" name="" id="product_id" value="{{$value->id}}">
        <a 
          href="javascript:void(0)" 
          id="delete-user" 
          data-url="{{ url('/product', $value->id) }}" 
          class="btn btn-danger btn-sm"
          ><i class="fa fa-trash"></i></a>
      </td>
  </tr>
  @endforeach
  @else
  <tr>
      <td colspan="8" class="text-bold text-danger text-center">
          No Data Found
      </td>
  </tr>
  @endif
</table> 
</div>

</body>
</html>
<script>
  let token = "{{ csrf_token() }}";
  $('body').on('click', '#delete-user', function () {
  var userURL = $(this).data('url');
  var trObj = $(this);
  var id = $('#product_id').val();
  swal({
    title: "Are you sure you want to remove this Product?",
    text: "You will not be able to recover this Product!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
 }).then((confirm) => {

   if (confirm){
        $.ajax({
            url: userURL,
            type: 'DELETE',
            dataType: 'JSON',
            data:{
                'id': id,
                '_token': '{{ csrf_token() }}',
            },
            success: function(result) {
                window.location.reload();
            }
        });

   }else{
        swal('Failed to delete');
   }
});

});
</script>
@endsection