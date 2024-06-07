<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<title>Document</title>
    <style>
      .error{
        color:red;
      }
    </style>
</head>
<body>
  @if ($message= Session::get('success'))
  <div class="alert alert-success alert-block" id="successMessage">
        <strong>{{ $message }}</strong>
  </div>
@endif
    <div class="container">
     

        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <a class="navbar-brand" href="#">State CRUD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('state.index')}}">Home</a>
                </li>
               </ul>
             
            </div>
          </nav>
          <br><br>
          <form action="{{route('state.store')}}" method="POST" id='form'>
            @csrf
            <div class="form-group" data-aos="fade-right">
              <label for="formGroupExampleInput">State name</label><span class="text-danger">*</span>
              @if ($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
              @endif
              <input type="text" class="form-control" name="name" id="name" placeholder="State name" value="{{$data->state_name??old('name')}}">
            </div>
            
            <div  class="form-group" data-aos="fade-left">
              <label for="formGroupExampleInput2">Status</label><span class="text-danger">*</span>
              @if ($errors->has('status'))
                <span class="text-danger">{{$errors->first('status')}}</span>
              @endif 
              <label id="status-error" class="error" for="status"></label>
              <br>
              <input type="radio" name="status" value="active" @if(isset($data->status)){ @if($data->status == 'active') @checked(true) @endif}@endif />Active
              <input type="radio" name="status" value="inactive" @if(isset($data->status)){ @if($data->status == 'inactive') @checked(true) @endif}@endif >Inactive
              <span class="error"></span>
            </div>
            <br>
            <input type="hidden" name="id"value="{{$data->id??''}}">
            <button class="btn btn-success" name="submit" value="{{$title}}" data-aos="fade-right">{{ucfirst($title)}}</button>
            <a href="{{route('state.index')}}" class="btn btn-danger" data-aos="fade-left">Cancle</a>
          </form>
    </div>

{{-- below libraries are for jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){ 
         $(".alert").fadeTo(1000, 500).slideUp(500, function(){
             $(".alert").slideUp(600);
             setTimeout(window.location.href = "{{route('state.index')}}", 1000);
           });
          
      })
      </script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
          AOS.init();
      </script>
</body>
{{-- below library is for select2() for having search bar in dropdown --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $('.curr').select2({
    multiple: true,
  });
 
</script>
{{-- below libraries are for validation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script>
  $("#form").validate({
    rules: {
        name: {
            required:true,
            pattern: /^[a-zA-Z'.\s]{1,40}$/
        },
        code: {
            required:true,
            pattern: /^[0-9\s]*$/
        },
        status: {
            required:true,
        },
        curr: {
            required:true,
        },
    },
    messages: {
        name: {
            required:'Please enter name',
            pattern: 'Please enter valid name'
        },
        code: {
            required:'Please enter code',
            pattern: 'Code should be a number'
        },
        status: {
            required:'Please select status'
        },
        curr: {
            required:'Please select currency'
        },
    }
});






</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>


