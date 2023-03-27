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
<h2>Order Management</h2>
<table>
  <tr>
    <th>SL.NO</th>
    <th>Order ID</th>
    <th>Customer name</th>
    <th>Phone</th>
    <th>Order date</th>
    <th>Actions</th>
  </tr>
  @if($order->count() > 0)
  <?php $i=1; ?>
  @foreach($order as $value)
  <tr>
    <td> {{ $i++ }}</td>
    <td>{{ $value->id ? $value->id : '--' }}</td>
    <td>{{ $value->customer_name ? $value->customer_name : '--' }}</td>
    <td>{{ $value->phone_number ? $value->phone_number : '--' }}</td>
    <td>{{ $value->created_at ? date('d/m/Y', strtotime($value->created_at)) : '--' }}</td>
    <td>
        <a href="{{ url('generate-invoice/'.$value->id) }}"><i class="fa fa-download"></i> </a>
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
  function deleteOrder(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) { 
                    $.ajax({
                        type: "DELETE",
                        url: '/delete-order/id',
                        async: true,
                        data: {
                            '_token': token,
                            'orderId': id,
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                if (response == "Success") {
                                    swal("Success!", "claim deleted successfully.", "success", {
                                        button: "Ok",
                                    }).then(function() {
                                        location.reload();
                                    });
                                }
                                if (response == "Error") {
                                    swal("Error!", "Error deleting claims!.", "error", {
                                        button: "Ok",
                                    })
                                }
                            } else {
                                console.log("Error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled!", "You cancelled the operation.", "error", {
                        button: "Ok",
                    })
                }
            });
    }
</script>
@endsection