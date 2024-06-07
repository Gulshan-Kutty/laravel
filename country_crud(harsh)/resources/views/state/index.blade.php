<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
  @if ($message= Session::get('success'))
  <div class="alert alert-success alert-block" id="successMessage">
        <strong>{{ $message }}</strong>
  </div>
@endif
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <a class="navbar-brand" href="{{route('country.index')}}">State CRUD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('country.index')}}">Home</a>
                </li>
               </ul>
             </div>
          </nav>

          <a href="{{route('state.create')}}" class="btn btn-success float-right mt-2 mb-2" style="float: right" >Create State</a>
        
<table class="table" data-aos="fade-right">

    <th>id</th>
    <th>name</th>
    <th>status</th>
    <th>Action</th>
    <tr>
        @foreach ($data as $row )
        <td>{{$row->id}}</td>
        <td>{{$row->state_name}}</td>
        <td>{{$row->status}}</td>
        <td><a href="{{route('state.show',base64_encode($row->id))}}" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
            <a href="{{route('state.update',base64_encode($row->id))}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
            <a href="{{route('state.delete',base64_encode($row->id))}}"  onclick="return confirm('Want to delete this country??')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            {{-- <a href="{{url('https://www.google.com/maps/place/'.$row->country_name)}}" target="blank" class="btn btn-info btn-sm">Map</a> --}}
        </td>
        
        
    </tr>
    @endforeach

</table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){ 
     $(".alert").fadeTo(1000, 500).slideUp(500, function(){
         $(".alert").slideUp(600);
         setTimeout(window.location.href = "{{route('state.index')}}", 1000);
       });
      
  })
  $(document).ready(function(){ 
     $(".fade").fadeTo(3000, 200);
      
  })
  </script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>