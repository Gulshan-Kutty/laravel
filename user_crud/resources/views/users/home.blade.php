<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/css/bootstrap-toaster.min.css')}}">


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
            <a class="nav-link text-light" href="{{route('users.home')}}">Homepage</a>
          </li>
        </ul>
      </nav>
      <div class="container">
        <div class="row">
            <h2 class='mt-3 ml-3'>Products List</h2>
            <button type='submit' class='btn btn-primary mt-3 ml-auto mr-3' onclick="window.location='{{ route('users.create')}}'">Create User</button>
        </div>
        <table class='mt-3' border='2px solid black' cellspacing='0' cellpadding='5px' width='100%'>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Dob</th>
                <th>Gender</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Photo</th>
                <th width="250px">Action</th>
            </tr>
            @foreach ($data as $row)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{$row->mob}}</td>
                    <td>{{$row->dob}}</td>
                    <td>{{$row->gender}}</td>
                    <td>{{$row->country_name}}</td>
                    <td>{{$row->state_name}}</td>
                    <td>{{$row->city_name}}</td>
                    <td><img src="{{ url('public/users/'.$row->image)}}" class="rounded-circle" width="50" height="50"></td>
                    <td>
                        <a href="{{ route('users.edit', base64_encode($row->id))}}" class='btn btn-info'>Edit</a>
                        <a href="{{ route('users.delete', base64_encode($row->id))}}" class="btn btn-danger" onclick="return confirm('Do you really want to remove this record?')">Delete</a>
                        <a href="{{ route('users.view', base64_encode($row->id))}}" class='btn btn-secondary'>View</a>
                    </td>
                </tr>
            @endforeach


        </table>
    </div>
    </body>
    </html>
