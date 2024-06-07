<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">

</head>
<body>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Register</h1>
                </div>
                <div class="card-body">
                    @if ($message= Session::get('success'))
                    <div class="alert alert-success alert-block" id="successMessage">
                    <strong>{{ $message }}</strong>
                    </div> 
                    @endif 
                    @if ($message= Session::get('error'))
                    <div class="alert alert-danger alert-block" id="successMessage">
                    <strong>{{ $message }}</strong>
                    </div> 
                    @endif   
                    <form action="{{route('auth.registerData')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-grid">
                        <a href="{{route('auth.login')}}" class="btn btn-info">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){ 
           $(".alert").fadeTo(1000, 500).slideUp(500, function(){
               $(".alert").slideUp(600);
               setTimeout(window.location.href = "{{route('auth.register')}}", 1000);
             });
            
        })
        $(document).ready(function(){ 
           $(".fade").fadeTo(3000, 200);
            
        })
        </script>
</body>
</html>
