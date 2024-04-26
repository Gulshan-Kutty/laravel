<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('products.index')}}">Products</a>
          </li>
        </ul>
      
      </nav>
    <div class="container">
      <div class='text-right'>
        <a href="{{route('products.create')}}" class='btn btn-dark mt-2'>Create Product</a>
      </div>
      <h1>Products List</h1>
      <table border="1px solid black" cellspacing="0" cellpadding="5px" width="100%">
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        @foreach ($test as $row)
        <tr>
          <td>{{$row->name}}</td>
          <td>{{$row->description}}</td>
          <td><img src="{{ url('public/products/'.$row->image)}}" class="rounded-circle" width="50" height="50"></td>
          <td>
            <a href="{{route('products.edit', base64_encode($row->id))}}" class="btn btn-info">Edit</a>
						<a href="{{ route('products.delete', base64_encode($row->id))}}" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you really want to remove this record?')">Delete</a>
          </td>
        </tr>
        @endforeach
      </table>
   
    </div>
</body>
</html>