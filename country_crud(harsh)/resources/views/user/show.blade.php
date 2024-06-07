<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-6">
           <div class="card mt-2 p-3">
@php
//    print_r($cdata->toArray());exit; 
@endphp
            @foreach ($cdata as $key )
            <span>Name : {{ucfirst($key->name)}}</span><br>
            <span>email : {{ucfirst($key->email)}}</span><br>
            <span>mobile : {{ucfirst($key->mobile)}}</span><br>
            <span>gender : {{ucfirst($key->gender)}}</span><br>
            <span>Country  : {{ucfirst($key->country_name)}}</span><br>
          <span>State  : {{ucfirst($key->state_name)}}</span><br>
         <span> city  : {{ucfirst($key->city_name)}}</span><br>
          <span>Status : {{ucfirst($key->status)}}</span><br>
          <span>Image : <img src="{{url('public/users/'.$key->image)}}" alt="" width="100px" height="100px"></span>
                
            @endforeach
             
            
            </div><br><a href="{{route('user.index')}}" class="btn btn-success btn-sm">Home</a>
        </div>
    </div>
</div>

   
</body>
</html>