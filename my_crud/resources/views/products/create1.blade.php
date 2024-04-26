<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="{{url('public/js/jquery-3.7.1.min.js')}}"> -->
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
            <div class="col-md-8">
            <div class="card mt-3 p-3">
            <form action="{{ route('products.store')}}" method='post' enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input class='form-control' name='name' type="text" placeholder="Product name" value={{$info->name ?? old('name')}}>
                    {{-- 'old('name')' will work during create and '$info->name' will work during update
                      
                    $info->name: This part retrieves the value of the "name" property from the $info object. If $product is not null and has a "name" property, it will display that value in the input field. This case will happen in case of 'edit' because when we click on 'edit' button we get some value in '$info->name' .

                    ??: This is the null coalescing operator in PHP. It checks if the value before it is null. If it is null, it evaluates the expression after it. This is useful for providing a default value if the variable or property is null.

                    old('name'): This function retrieves the value of the "name" input field from the previous request. It's typically used for displaying the previously entered value if there was a validation error and the form needs to be redisplayed with the old input.This case will happen in case of 'create' because when we click on 'create' button we get null in '$info->name' --}}
                    @if ($errors->has('name'))
                    <span class='text-danger'>{{ $errors->first('name')}}</span>  
                    @endif                  
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                   <textarea class='form-control' name="description" id="" cols="30" rows="5" placeholder="Product description">{{$info->description ?? old('description')}}</textarea>
                   @if ($errors->has('description'))
                   <span class='text-danger'>{{ $errors->first('description')}}</span>  
                   @endif
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input class='form-control' name='image' type="file">
                    @if ($errors->has('image'))
                    <span class='text-danger'>{{ $errors->first('image')}}</span><br>    
                    @endif
                    

                    @if(isset($info->image))
                    <img src="{{url('public/products/'.$info->image)}}" height='100px' width='100px' alt="Current Image" class='mt-3'>
                    @endif {{-- if we click on create button then variable '$info' will throw error because in this case '$info->image' is not set/defined hence we have to put this image code inside the condition so that we wont get any error. --}}
                </div>
                {{-- <button type="submit" class='btn btn-primary'>Submit</button> --}}
                <input type="hidden" name="id" value="{{ $info->id ?? ''}}"> {{-- if we click on 'edit' then we get value as '$info->id' and if we click on 'create' we get empty value because in this case '$info->id' will be null  --}}
                <button type="submit" value='{{ $title }}' name='button' class='btn btn-primary'>{{$title}}</button>
                <a class="btn btn-danger" href="{{route('products.home')}}">Cancel</a>

            </form>
        </div>
        </div>
        </div>
    </div>  
</body>
</html>