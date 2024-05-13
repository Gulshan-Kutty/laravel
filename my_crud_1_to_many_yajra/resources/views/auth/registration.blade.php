<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
                <h3>Registration</h3>
                <hr>
                <form action="{{route('registerUser')}}" method="post">
                    @csrf
                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>     
                    @endif
                   <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter your name" name="name" id="name" value="{{old('name')}}">
                        <span class="text-danger">@error('name'){{$message}} @enderror</span>
                   </div>
                   <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Enter email address" name="email" id="email" value="{{old('email')}}">
                        <span class="text-danger">@error('email'){{$message}} @enderror</span>

                   </div>
                   <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password" id="password">
                        <span class="text-danger">@error('password'){{$message}} @enderror</span>

                   </div>
                   <button class="btn btn-primary" type="submit">Register</button><br>
                   <a href="{{route('login')}}">Already Registered! Login here</a>

                </form>
            </div>
        </div>
    </div>
</body>
</html>