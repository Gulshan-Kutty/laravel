<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{route('countries.home')}}">Homepage</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-2 mt-3">
                    <h5 for="">Name:<b>{{$info->country_name}}</b> </h5>
                </div>
                <a class="btn btn-danger mt-2" href="{{route('countries.home')}}">Back</a>
            </div>
        </div>
    </div>
</body>

</html>