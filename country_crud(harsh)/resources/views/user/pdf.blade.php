<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">

    <title>Document</title>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
               <th colspan="9" align="center" style="background: #ffffb3"><b>User Data</b></th>
            </tr>
        <tr>
            <th style="background: #ccffff"><b>Name</b></th>
            <th style="background: #ccffff"><b>Email</b></th>
            <th style="background: #ccffff"><b>Mobile</b></th>
            <th style="background: #ccffff"><b>Gender</b></th>
            <th style="background: #ccffff"><b>Country</b></th>
            <th style="background: #ccffff"><b>State</b></th>
            <th style="background: #ccffff"><b>City</b></th>
            <th style="background: #ccffff"><b>Image</b></th>
            <th style="background: #ccffff"><b>Status</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->country->country_name }}</td>
                <td>{{ $user->state->state_name }}</td>
                <td>{{ $user->city->city_name }}</td>
                <td> <img src="{{url('public/users/'.$user->image)}}" class="rounded-circle" width='50' height="50" alt=""></td>
                <td>{{ $user->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>