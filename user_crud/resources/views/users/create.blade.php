<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <title>Create Page</title>
 
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3 p-3">
                    <form action="{{route('users.store')}}" method="POST" id='form' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" value="{{ $info->name ?? old('name')}}">
                            <span class="text-danger" id="nameError"></span>
                            {{-- @if ($errors->has('name'))
                            <span class='text-danger'>{{ $errors->first('name')}}</span>  
                            @endif  --}}
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class='form-control' id="address" name="address" placeholder="Enter address" cols="30" rows="10">{{$info->address ?? old('address')}}</textarea>
                            <span class="text-danger" id="addressError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="text" placeholder="Enter mobile number" value="{{ $info->email ?? old('email')}}">
                            <span class="text-danger" id="emailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="mob">Mobile Number</label>
                            <input class="form-control" id="mob" name="mob" type="text" placeholder="Enter mobile number" value="{{ $info->mob_no ?? old('mob')}}">
                            <span class="text-danger" id="mobError"></span>
                        </div>
                        <div class="form-group">
                            <label for="dob">DOB</label>
                            <input class="form-control" id="dob" name="dob" type="text" placeholder="Enter your birth date" value="{{ $info->dob ?? old('dob')}}">
                            <span class="text-danger" id="dobError"></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="other" value="other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                            <span class="text-danger" id="genderError"></span>
                        </div>
                        <div class="form-group">
                            <label for="country">Select Country</label><br>
                            <select class="dropdown col-sm-6 "  name="country" id='country'>
                                <option value="">Select Country</option>
                                @foreach ($countries as $row1 )
                                <option value="{{$row1->id}}">{{$row1->name}}</option>
                                @endforeach
                            </select>   
                        </div> 
                        <div class='form-group'>
                            <label for="state">Select State</label>
                            <select id='state' class="form-control" name="state">
                            </select>
                        </div>
                        <div class='form-group'>
                            <label for="city">Select City</label>
                            <select id='city' class="form-control" name="city">
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class='form-control' id="image" name='image' type="file" value="{{$info->image?? old('image')}}">
                            <span class="text-danger" id="imageError"></span>
                            @if(isset($info->image))
                            <img src="{{url('public/users/'.$info->image)}}" height='100px' width='100px' alt="Current Image" class='mt-3'>
                            @endif 
                        </div>
                        <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                        <button id='btn' type="button" value="{{$title}}" name="button" class="btn btn-primary mb-2">{{$title}}</button>
                        <a class="btn btn-danger" href="{{route('users.home')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
    
{{-- <script src="{{url('public/js/jquery-3.7.1.min.js')}}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#country').change(function(event){  // used different approach here
                var idCountry = $(this).val();
                // alert(country_id);
                $('#state').html('');

                $.ajax({
                    url : "{{ route('fetch_state') }}",
                    type : 'post',
                    dataType: 'json',
                    data: {
                        country_id: idCountry, _token:"{{ csrf_token()}}"
                    },
                    success: function(response){
                        // console.log(response);
                        // $('#state').html('<option value="">Select State</option>');
                        // $.each(response.states, function(index, state){
                        //     $('#state').append('<option value="'+state.id+'">'+state.name+'</option>');
                        // });
                        $('#state').html(response.html); // Accessing the HTML content from the JSON response

                        $('#city').html('<option value="">Select City</option>');

                    }
                });

            });

    $('#state').change(function(event){ // used different approach here
        var idState = $(this).val();
        // alert(country_id);
        $('#city').html('');

        $.ajax({
            url : "{{ route('fetch_city') }}",
            type : 'post',
            dataType: 'json',
            data: {
                state_id: idState, _token:"{{ csrf_token()}}"
            },
            success: function(response){ // it takes print_r, echo and json
                // console.log(response);return false;
                $('#city').html('<option value="">Select City</option>');
                $.each(response.cities, function(index, city){
                    $('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
                });

            }
        });

    });

            // Ajax without form tag
            // $('#btn').click(function(event) {
            //     // event.preventDefault(); // Prevent the default form submission(i.e after submission it should not refresh the page)

            //     // Prepare form data
            //     var formData = {
            //         name: $('#name').val(),
            //         address: $('#address').val(),
            //         email: $('#email').val(),
            //         mob: $('#mob_no').val(),
            //         dob: $('#dob').val(),
            //         gender: $('#gender').val(),
            //         country_id: $('#country').val(),
            //         state_id: $('#state').val(),
            //         city_id: $('#city').val(),
            //         image: $('#image').val(),
            //         button: $('#btn').val(),
            //         _token:"{{ csrf_token()}}",
            //         // Include other form fields here
            //     };
            //     // event.preventDefault(); // Prevent the default form submission
                
                
            //     // Send an Ajax request to handle form submission
            //     $.ajax({
            //         url: "{{ route('users.store') }}",
            //         type: 'POST',
            //         data: formData,
            //         success: function(response) {
            //             console.log(response);return false;
            //             // Handle success response, for example, show a success message or redirect the user
            //             // alert('message');
            //             window.location.href = "{{ route('users.home') }}"; // Redirect to home page
            //         }
                    
            //     });
            // });


            // Ajax with form tag
            $('#btn').click(function(event){
                // event.preventDefault();
                
                formData = $('#form').serialize(); //  it collects all the input fields within the form and serializes them into a string.
                  
              //  console.log(formdata);//This is a useful technique for debugging to ensure that your form is correctly capturing all the user input before proceeding with further actions, such as AJAX submission or form submission.
                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: 'POST',
                    data:  formData,
                    success: function(response) {
                        console.log(response); // 'return false' terminates the code here itself.
                        // window.location.href = "{{ route('users.home') }}"; // Redirect to home page
                    }
                });
            });
</script>

<script>
//     $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// })
    // $(document).ready(function () {
    //     $('#form').submit(function (e) {
    //         e.preventDefault();
            
    //         var formData = new FormData($(this)[0]); // Serialize the form data except the file input
    //         // formData.append('image', $('#image')[0].files[0]); // Append the file manually
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route("users.store") }}',
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //             success: function (response) {
    //                 console.log(response);
    //                 // Handle success response
    //                 window.location.href = "{{ route('users.home') }}";
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(xhr.responseText);
    //                 // Handle error response
    //             }
    //         });
    //     });
    // });
</script>
</html>