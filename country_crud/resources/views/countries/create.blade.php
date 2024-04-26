<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
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
            <div class="col-md-8">
            <div class="card mt-3 p-3">
            <form action="{{ route('countries.store')}}" method='post' enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label for="">Country Name</label>
                    <input class='form-control' name='name' type="text" placeholder="Enter country name" value={{$info->country_name ?? old('name')}}>
                    @if ($errors->has('name'))
                    <span class='text-danger'>{{ $errors->first('name')}}</span>  
                    @endif 
                </div>
                <div class="form-group">
                    <label for="">Country Code</label>
                    <input class='form-control' name='code' type="text" placeholder="Enter country code" value={{$info->country_code ?? old('code')}}>
                    @if ($errors->has('code'))
                    <span class='text-danger'>{{ $errors->first('code')}}</span>  
                    @endif 
                </div>
  
                {{-- <button type="submit" class='btn btn-primary'>Submit</button> --}}
                <input type="hidden" name="id" value="{{ $info->id ?? ''}}"> {{-- if we click on 'edit' then we get value as '$info->id' and if we click on 'create' we get empty value because in this case '$info->id' will be null  --}}
                <button type="submit" value='{{ $title }}' name='button' class='btn btn-primary'>{{$title}}</button>
                <a class="btn btn-danger" href="{{route('countries.home')}}">Cancel</a>

            </form>
        </div>
        </div>
        </div>
    </div>
</body>
</html>