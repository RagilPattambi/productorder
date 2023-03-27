<!DOCTYPE html>
<html>
<style>
table, td, th {
  border: 1px solid black;
  height:3%;
}
table {
  border-collapse: collapse;
  width: 100%;
}
th {
  text-align: left;
}
</style>
<body>
    <hr><br>
    <table>
  <tr>
    <th>Order ID</th>
    <td>{{ $invoice[0]['order_id'] }}</td>
  </tr>
  <tr>
    <th>Products</th>
    <td>@foreach($invoice as $inv)
      <ol>
        <li>{{$inv['product_name']}} x {{$inv['quantity']}} = {{$inv['total_price']}}</li>
      </ol>
    @endforeach
  </td>
  </tr>
  <tr>
    <th>Total</th>
    <td>{{array_sum(array_column($invoice,'total_price'));}}</td>
  </tr>
</table>

    </body>
</html>