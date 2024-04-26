<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <style>
        .navbar {
            height: 80px; /* Change the height value as needed */
        }
    
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{route('products.home')}}">Homepage</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-2 mt-3">
                    <h5 for="">Name:<b>{{$info->name}}</b> </h5>
                    <h5 for="">Description:<b>{{$info->description}}</b> </h5>
                    {{-- without using relation --}}
                    <h5 for="">Countries:<b>{{$info->country_name}}</b> </h5>
                    {{-- using relation --}}
                    {{-- <h5 for="">Countries:<b>{{$info->country->country_name}}</b> </h5> --}}
                    <h5>Image:<br><img src="{{url('public/products/'.$info->image)}}" height='200px' width='200px' alt=""></h5>
                </div>
                <a class="btn btn-danger mt-2" href="{{route('products.home')}}">Back</a>
            </div>
        </div>
    </div>
</body>

</html>