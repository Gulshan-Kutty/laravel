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
    <table border="1px">
        <thead>
            <tr>
               <th colspan="9" align="center" style="background: #ffffb3"><b>User Data</b></th>
            </tr>
        <tr>
            <th style="background: #ccffff ; border:2px solid black "><b>Name</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Email</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Mobile</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Gender</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Country</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>State</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>City</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Image</b></th>
            <th style="background: #ccffff ; border:2px solid black"><b>Status</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td style="border:2px solid red">{{ $user->name }}</td>
                <td style="border:2px solid red">{{ $user->email }}</td>
                <td style="border:2px solid red">{{ $user->mobile }}</td>
                <td style="border:2px solid red">{{ $user->gender }}</td>
                <td style="border:2px solid red">{{ $user->country->country_name }}</td>
                <td style="border:2px solid red">{{ $user->state->state_name }}</td>
                <td style="border:2px solid red">{{ $user->city->city_name }}</td>
                <td style="border:2px solid red">{{url('public/users/'.$user->image)}}</td>
                <td style="border:2px solid red">{{ $user->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>