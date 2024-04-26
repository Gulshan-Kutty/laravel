<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/css/bootstrap-toaster.min.css')}}">
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

    <style>
        .navbar {
            height: 80px; /* Change the height value as needed */
        }
    
    </style>
</head>
<body>
    @php
        // print_r($data1->toArray());exit;
    @endphp
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('products.home')}}">Homepage</a>
          </li>
        </ul>
      </nav>
      <div class="container">
        <div class="row">
            <h2 class='mt-3 ml-3'>Products List</h2>
            <button type='submit' class='btn btn-primary m-3 ml-auto ' onclick="window.location='{{ route('products.create')}}'">Create Product</button>
        </div>
             
        <table class='table table-bordered mt-3'>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Description</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Countries</th>
                <th>Image</th>
                <th width="250px">Action</th>
            </tr>
            @foreach ($data as $row)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td>{{$row->from_date}}</td>
                    <td>{{$row->to_date}}</td>
                    <td>{{$row->country->country_name}}</td>
                    <td><img src="{{ url('public/products/'.$row->image)}}" class="rounded-circle" width="50" height="50"></td>
                    <td>
                        <a href="{{ route('products.edit', base64_encode($row->id))}}" class='btn btn-info'>Edit</a>
                        <a href="{{ route('products.delete', base64_encode($row->id))}}" class="btn btn-danger" onclick="return confirm('Do you really want to remove this record?')">Delete</a>
                        <a href="{{ route('products.view', base64_encode($row->id))}}" class='btn btn-secondary'>View</a>
                    </td>
                </tr>
            @endforeach


        </table>
    </div>
    </body>
    </html>
