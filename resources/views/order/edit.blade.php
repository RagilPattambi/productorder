<!DOCTYPE html>
<html>
<head>

</head>
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #f1f1f1;
}

.topnav a {
  float: left;
  display: block;
  color: black;
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
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>
<div class="topnav">
  <a class="active" href="{{ url('/')}}">Home</a>
  <a href="">News</a>
  <a href="#contact">Contact</a>
</div>
<div style="padding-left:16px"><br>
<form method="POST" action="{{ url('update-order/'.encrypt($order->id)) }}">
    @csrf
    <label>Order ID</label>
    <input type="text" id="order_id" name="order_id" placeholder="Enater Order ID" value="{{ $order->order_id }}">

    <label>Customer name</label>
    <input type="text" id="customer_name" name="customer_name" placeholder="Enater Customer name" value="{{ $order->customer_name }}">

    <label>Phone</label>
    <input type="text" id="phone" name="phone" placeholder="Enater phone" value="{{ $order->phone }}">

    <label>Net amount</label>
    <input type="text" id="net_amount" name="net_amount" placeholder="Enater Net amount" value="{{ $order->net_amount }}">

    <label>Product Name</label>
    <select id="category" name="category">
      <option value="">select category</option>
      <option value="1" <?php if ($product->product_name == "1") { ?> selected <?php }  ?>>Soni TV</option>
      <option value="2" <?php if ($product->product_name == "2") { ?> selected <?php }  ?>>Oneplas Buds</option>
    </select>

    <label>Order date</label>
    <input type="date" id="order_date" name="order_date" placeholder="Enater Order date" value="{{ $order->order_date }}"><br><br>

    <input type="submit" value="Submit">
    <a href="{{ url('list-order')}}">Order list</a>
  </form>

</div>

</body>
</html>