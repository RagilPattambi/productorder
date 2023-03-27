@extends('layout')


@section('content')
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
<form method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Product Name</label>
    <input type="text" id="product_name" name="product_name" placeholder="Enater product_name"  value="{{ $product->product_name }}">

    <label>Category</label>
    <select id="category" name="category">
      <option value="">select category</option>
      <option value="1" <?php if ($product->category_id == "1") { ?> selected <?php }  ?>>Television</option>
      <option value="2" <?php if ($product->category_id == "2") { ?> selected <?php }  ?>>Headphones</option>
    </select>
    <input type="text" id="price" name="price" placeholder="Enter price">
    <div class="form-group mb-5">
    <input type="file" name="file" id="file" class="form-control m-input" placeholder="Select File to upload" autocomplete="off">
    </div>
    <div><img src="/images/{{$product->image}}" alt="test" class="img-thumbnail" width="150" height="50"></div>

    </div>
    <input type="submit" value="Submit">
    <a href="{{ url('product')}}">Product list</a>
  </form>

</div>

@endsection