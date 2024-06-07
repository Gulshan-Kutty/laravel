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
    {{-- <?php dd($users) ?> --}}
    <table>
        <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Email</b></th>
            <th><b>Mobile</b></th>
            <th><b>Gender</b></th>
            <th><b>Country</b></th>
            <th><b>State</b></th>
            <th><b>City</b></th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>