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
                <h3>Login</h3>
                <hr>
                <form action="{{route('loginUser')}}" method="post">
                    @csrf
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>     
                    @endif
                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>     
                    @endif
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
                   <button class="btn btn-primary" type="submit">Login</button><br>
                   <a href="{{route('registration')}}">New user! Register here</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>