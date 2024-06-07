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
      @php
      // dd($city->toArray());
      @endphp
      {{-- @php print_r($data->toArray()); @endphp --}}
      <div class="container">
         @php
         //  print_r($country_data);exit;
         @endphp
         <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <a class="navbar-brand" href="#">User CRUD</a>
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
         <br><br>
         <div >
            {{-- <?php dd($city->toArray());?> --}}
            <form action="{{route('user.store')}}" method="POST" id='form'  enctype="multipart/form-data">
               @csrf
               <div  data-aos="fade-right" >
                  <label for="formGroupExampleInput">User name</label><span class="text-danger">*</span>
                  @if ($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                  <input type="text" class="form-control" name="name" id="name" placeholder="User name" value="{{$data->name??old('name')}}" >
               </div><br>
               <div  data-aos="fade-left">
                  <label for="formGroupExampleInput">User email</label><span class="text-danger">*</span>
                  @if ($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif
                  <input type="text" class="form-control" name="email" id="email" placeholder="User email" value="{{$data->email??old('name')}}">
               </div><br>
               <div  data-aos="fade-right">
                  <label for="formGroupExampleInput">User mobile</label><span class="text-danger">*</span>
                  @if ($errors->has('mobile'))
                  <span class="text-danger">{{$errors->first('mobile')}}</span>
                  @endif
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="User mobile" value="{{$data->mobile??old('name')}}">
               </div><br>
               <div   data-aos="fade-left">
                  <label for="formGroupExampleInput2">Status</label><span class="text-danger">*</span>
                  @if ($errors->has('status'))
                  <span class="text-danger">{{$errors->first('status')}}</span>
                  @endif 
                  <label id="status-error" class="error" for="status"></label>
                  <br>
                  <input type="radio" name="status" value="active" id="status" @if(isset($data->status)){ @if($data->status == 'active') @checked(true) @endif}@endif />Active
                  <input type="radio" name="status" value="inactive" id="status" @if(isset($data->status)){ @if($data->status == 'inactive') @checked(true) @endif}@endif >Inactive
                  <span class="error"></span>
               </div>
               <br>
               <div   data-aos="fade-right">
                  <label for="formGroupExampleInput2">Gender</label><span class="text-danger">*</span>
                  @if ($errors->has('gender'))
                  <span class="text-danger">{{$errors->first('gender')}}</span>
                  @endif 
                  <label id="gender-error" class="error" for="gender"></label>
                  <br>
                  <input type="radio" name="gender" id="gender" value="male" @if(isset($data->gender)){ @if($data->gender == 'male') @checked(true) @endif}@endif />Male
                  <input type="radio" name="gender" id="gender" value="female" @if(isset($data->gender)){ @if($data->gender == 'female') @checked(true) @endif}@endif >Female
                  <span class="error"></span>
               </div>
               <br>
               <div class="form-group " data-aos="fade-left">
                  <label for="state">Choose a country:</label>@if ($errors->has('country'))
                  <span class="text-danger">{{$errors->first('country')}}</span>
                  @endif 
                  {{-- <label id="curr-error" class="error" for="curr"></label> --}}
                  <select name="country[]" class="cou" id="country" >
                     <option value="{{$data->country_id??old('name')}}" style="width: 160px;">Select Country
                     </option>
                     @foreach ($country as $test)
                     <option value="{{$test->id}}" {{ ($test->id == old('country',$data->country_id??''))?'selected':'' }} style="width: 160px;"> {{ $test->country_name }} </option>
                     @endforeach
                  </select>
                  <label id="curr-error" class="error" for="curr"></label>
               </div>
               <div  >
                  <label for="state">Choose a state:</label>@if ($errors->has('state'))
                  <span class="text-danger">{{$errors->first('state')}}</span>
                  @endif 
                  {{-- <label id="curr-error" class="error" for="curr"></label> --}}
                  <select name="state[]" class="curr" id="state">
                     <option value="{{$data->state_id??old('name')}}" style="width: 160px;"> Select State 
                     </option>
                     @foreach ($state as $test)
                     <option value="{{$test->id}}" {{ ($test->id == old('state',$data->state_id??''))?'selected':'' }} style="width: 160px;"> {{ $test->state_name }} </option>
                     @endforeach
                  </select>
                  <label id="curr-error" class="error" for="curr"></label>
               </div>
               <div  >
                  <label >Choose a city:</label>@if ($errors->has('city'))
                  <span class="text-danger">{{$errors->first('city')}}</span>
                  @endif 
                  {{-- <label id="curr-error" class="error" for="curr"></label> --}}
                  <select name="city[]" class="curr" id="city" >
                     <option value="{{$data->city_id??old('name')}}" style="width: 160px;">Select City
                     </option>
                     @foreach ($city as $test)
                     <option value="{{$test->id}}" {{ ($test->id == old('city',$data->city_id??''))?'selected':'' }} style="width: 160px;"> {{ $test->city_name }} </option>
                     @endforeach
                  </select>
                  {{-- <label id="curr-error" class="error" for="curr"></label> --}}
               </div><br>
               <div >
                  <label>{{ucfirst($title)}} Profile Photo</label>
                  <input type="file" name="image" class="form-control" id="image" value="{{$data->image ?? old('image')}}">
                  @if (isset($data) && $data->image!=null)
                  <img src="{{ url('public/users/'.$data->image)}}" width="100px" height="100px">
                  @endif  
                  @if ($errors->has('image'))
                  <span class="text-danger">{{$errors->first('image')}}</span>                            
                  @endif
               </div>
               <br>
               <div >
                  <input type="hidden" name="id"value="{{$data->id??''}}">
                  <button class="btn btn-primary" name="submit" id="subbtn" value="{{$title}}" >{{ucfirst($title)}}</button>
                  <a href="{{route('user.index')}}" class="btn btn-danger" >Cancle</a>
               </div>
            </form>
         </div>
      </div>
      {{-- below libraries are for jquery --}}
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script>
         $(document).ready(function(){ 
            $(".alert").fadeTo(1000, 500).slideUp(500, function(){
                $(".alert").slideUp(600);
                setTimeout(window.location.href = "{{route('user.index')}}", 1000);
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
   <script>
      $('.cou').select2({
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
            email: {
                required:true,
               email:true
            },
            mobile: {
                required:true,
               number:true
            },
            city: {
                required:true,
                
            },
            status: {
                required:true,
            },
            gender: {
                required:true,
            },
            state: {
                required:true,
            },
            country: {
                required:true,
            },
        },
        messages: {
            name: {
                required:'Please enter name',
                pattern: 'Please enter valid name'
            },
            email: {
                required:'Please enter email',
                email: 'Please enter valid email'
            },
            mobile: {
                required:'Please enter mobile',
               number:'Please enter valid mobile',
            },
            city: {
                required:'Please enter code'
            },
            status: {
                required:'Please select status'
            },
            gender: {
                required:'Please select status'
            },
            state: {
                required:'Please select currency'
            },
            country: {
                required:'Please select currency'
            },
        
        }
      });
      
      
      
      
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <script>
      $('#country').change(function(){
      
        var cid=$(this).val();
        $.ajax({
      
          url:"fetch-state",
          type:"POST",
          data: { country_id:cid,_token:"{{csrf_token()}}"},
          success:function(result){
            $('#state').html(result)
          }
      
        })
      
      });
      
      $('#state').change(function(){
      
        var sid=$(this).val();
        $.ajax({
      
          url:"fetch-city",
          type:"POST",
          data: { state_id:sid,_token:"{{csrf_token()}}"},
          success:function(result){
            $('#city').html(result)
          }
      
        })
      
        });

//ajax using form tag
        $('#subbtn').click(function(event){
          formdata=$("#form").serialize();
         $.ajax({
            url:"{{route('user.store')}}",
            type:"POST",
            data:{formdata,_token:"{{ csrf_token()}}"},
            success:function(res){
               window.location.href ="{{route('user.index')}}";
            }
         })
        });


//ajax without using form tag
// let btn=$("#subbtn");
// let file=$('#image');
// $('#subbtn').click(function(){
//    let formData = new FormData();
//    let image=file.files[0];
//    console.log(image);
// })
   
//    $('#subbtn').click(function(event){
//          var data ={
//             name: $('#name').val(),
//             email: $('#email').val(),
//             mobile: $('#mobile').val(),
//             status: $('#status').val(),
//             gender: $('#gender').val(),
//             country: $('#country').val(),
//             state: $('#state').val(),
//             city: $('#city').val(),
//             image:$('#image').prop('files')[0],
//             subbtn: $('#subbtn').val(),
//             _token:"{{ csrf_token()}}"
            
//          }

//          $.ajax({
//             url:"{{route('user.store')}}",
//             type:"POST",
//             data:data,
//             success:function(res){
//                console.log(res);return false;
//                window.location.href ="{{route('user.index')}}";
//             }
//          })
//         });

   </script>

</html>