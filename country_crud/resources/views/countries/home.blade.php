<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('countries.home')}}">Homepage</a>
          </li>
        </ul>
      </nav>
      <div class="container">
        <div class="row">
            <h2 class='mt-3 ml-3'>Countries List</h2>
            <button type='submit' class='btn btn-primary mt-3 ml-auto mr-3' onclick="window.location='{{ route('countries.create')}}'">Create Country</button>
        </div>
        {{-- <table class='mt-3' border='2px solid black' cellspacing='0' cellpadding='5px' width='100%'> --}}
        <table class='table table-bordered mt-2'>
            <tr>
                <th>Sr.No</th>
                <th>Country Name</th>
                <th>Country Code</th>
                <th width="250px">Action</th>
            </tr>
            @foreach ($data as $row)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>{{$row->country_name}}</td>
                    <td>{{$row->country_code}}</td>
                    <td>
                        <a href="{{ route('countries.edit', base64_encode($row->id))}}" class='btn btn-secondary'>Edit</a>
                        <a href="{{ route('countries.delete', base64_encode($row->id))}}" class="btn btn-danger" onclick="return confirm('Do you really want to remove this record?')">Delete</a>
                        <a href="{{ route('countries.view', base64_encode($row->id))}}" class='btn btn-primary'>View</a>
                    </td>
                </tr>
            @endforeach


        </table>
        <div class="mt-2">
            {{ $data->links()}}
        </div>
    </div>
    </body>
    </html>
