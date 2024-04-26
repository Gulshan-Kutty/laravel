<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="{{ url('public/css/bootstrap.min.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">

        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('products.index')}}">Products</a>
          </li>
        </ul>
      
      </nav>
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-sm-8">
            <div class="card mt-3 p-3">
              <form method='POST' action="{{route('products.store')}}" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name='name' class='form-control' placeholder="Please Enter Name" value={{ $product->name ?? old('name')}}>
                  {{-- value={{ $product->name ?? old('name')}}: This attribute sets the initial value of the input field. Let's break it down further:

                  $product->name: This part retrieves the value of the "name" property from the $product object. If $product is not null and has a "name" property, it will display that value in the input field. This case will happen in case of 'edit'.

                  ??: This is the null coalescing operator in PHP. It checks if the value before it is null. If it is null, it evaluates the expression after it. This is useful for providing a default value if the variable or property is null.

                  old('name'): This function retrieves the value of the "name" input field from the previous request. It's typically used for displaying the previously entered value if there was a validation error and the form needs to be redisplayed with the old input.
                  This case will happen in case of 'create' because when we click on 'create' button we get null in '$product->name' 

                  So, the value attribute of the input field will be set to $product->name if $product exists and has a "name" property. If $product is null or doesn't have a "name" property, it will fall back to the value entered in the "name" field from the previous request, using old('name'). --}}
                  @if($errors->has('name')) 
                  <span class='text-danger'>{{ $errors->first('name')}}</span> {{-- This line starts an @if statement in Blade templating engine. It checks if there are any validation errors associated with the "name" field. The $errors variable is provided by Laravel, and it holds any validation errors that occurred during form submission. The has() method is used to check if there are any errors for the specified field, in this case, "name".
                  If there are validation errors for the "name" field, this line generates HTML markup for displaying the first error message associated with that field.
                  {{ $errors->first('name')}}: This Blade directive {{ }} is used for echoing variables or values. Here, $errors->first('name') retrieves the first error message associated with the "name" field. If there are multiple validation errors for this field, first() returns only the first one.
                   --}}
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea class='form-control' name="description" id="" cols="30" rows="10">{{$product->description ?? old('description')}}</textarea> {{-- The initial value of the <textarea> is specified directly between the opening and closing <textarea> tags. Similar to the first case(old('name')), old('description') is used to repopulate the textarea with the old input value if the form submission fails validation.
                  So, in both cases, the purpose is to repopulate the form fields with the old input values if there was a form submission error, but the specific syntax differs because of the nature of the input elements. For <input>, you use the 'value' attribute, while for <textarea>, you specify the initial value between the tags.--}}
                  @if($errors->has('description'))
                  <span class='text-danger'>{{ $errors->first('description')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Image</label>
                  <input type="file" name='image' class='form-control' value={{ $product->image ?? old('image')}}>
                  {{-- @if($errors->has('image'))
                  <span class='text-danger'>{{ $errors->first('image')}}</span>
                  @endif --}}
                </div>
                <input type="hidden" name="id" value="{{ $product->id ?? ''}}">
                <button type='submit' value="{{$title}}" name="button" class='btn btn-dark'>{{$title}}</button>
                <a class="btn btn-danger" href="{{route('products.index')}}">Cancel</a>
              </form>
            </div>
          </div>
       </div>
    </div>
</body>
</html>