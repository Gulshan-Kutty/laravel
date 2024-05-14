<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('public/css/bootstrap.min.css')}}">
    <title>Create</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-3 p-3">
                    <form action="{{route('students.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="text" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input class="form-control" type="text" id="mobile" name="mobile">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="text" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">Gender:</label>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="">Female</label>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="">Other</label>
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            <select name="country" id="">
                                <option value="">--Select Country--</option>
                                @foreach ( $countries as $country)
                                <option value="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>