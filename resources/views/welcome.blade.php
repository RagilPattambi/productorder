@extends('layout')


@section('content')
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #33001a;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #000;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #000;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea, input[type=file] {
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
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'details')" style="color:#ccc">Product</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" style="color:#ccc">Order</button>
</div>
<div id="details" class="tabcontent">
<h2>Product</h2>
<div class="container">
  <div class="container" style="max-width: 700px;">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
        </div>
        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="text" name="product_name" id="product_name" class="form-control m-input" placeholder="Enter product name" autocomplete="off">
                            <select id="category" name="category">
                              <option value="" disabled selected>Select category</option>
                              <option value="1">Television</option>
                              <option value="2">Headphones</option>
                            </select>
                            <input type="text" id="price" name="price" placeholder="Enter price">
                            <div class="form-group mb-5">
                            <input type="file" name="file" id="file" class="form-control m-input" placeholder="Select File to upload" autocomplete="off">
                            </div>
                            <!-- <input type= "file" name="file" id="file" class="form-control m-input" placeholder="Select File to upload" autocomplete="off"> -->
                        </div>
                    </div>
                </div>
            </div><br>
            <input type="submit" value="Submit">
            <a href="{{ url('list-product')}}">Product list</a>
        </form>
    </div>
</div>
</div>

<div id="Paris" class="tabcontent">
  <h3>Order</h3>
  <form method="POST" action="{{ route('order.store') }}">
    @csrf
    <label>Customer name</label>
    <input type="text" id="customer_name" name="customer_name" placeholder="Enter Customer name">

    <label>Phone</label>
    <input type="text" id="phone" name="phone" placeholder="Enter phone">

    <label>Product Name</label>
    <select id="product" name="more[0][product]">
      <option value="" disabled selected>Select Product</option>
      @if($product->count() > 0)
      @foreach($product as $pro)
      <option value="{{$pro->id}}">{{$pro->product_name}}</option>
      @endforeach
      @endif
    </select>
    <input type="text" name="more[0][quantity]" id="quantity" class="form-control" placeholder="Enter quantity">
    <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                            <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>

    <input type="submit" value="Submit">
    <a href="{{ url('order')}}">Order list</a>
  </form>

  
</div>

<script>
  $(document).ready(function() {
    openCity(event, 'details');
  });
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

var i = 0;

$("#addRow").click(function () { 
  ++i;       
        $.ajax({
            url: '/list/'+i,
            type: 'GET',
            success: (response) => {
                // success
                $('#newRow').append(response);
            }
        });
});

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
</script>
   
@endsection
