<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <title>Create Page</title>
    {{-- datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- multiselect --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
 
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3 p-3">
                    <form id='form' action="{{route('products.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Product Name" value="{{ old('name', $info->name) }}">
                            {{-- @php print_r(is_null(old('name'))); @endphp --}}
                            {{-- <span class="text-danger" id="nameError"></span> --}}
                            {{-- @if ($errors->has('name'))
                            <span class='text-danger'>{{ $errors->first('name')}}</span>  
                            @endif  --}}
                            @error('name')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="text" placeholder="Enter Email" value="{{ old('email', $info->email) }}">
                            <span class="text-danger" id="emailError"></span>
                            @error('email')
                                <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class='form-control' id="description" name="description" placeholder="Product Description" cols="30" rows="10">{{ old('description', $info->description) }}</textarea>
                            {{-- <span class="text-danger" id="descriptionError"></span> --}}
                            @if ($errors->has('description'))
                            <span class='text-danger'>{{ $errors->first('description')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input class="form-control" id="from_date" name="from_date" type="text" placeholder="Select Date" value="{{ old('from_date', $info->from_date) }}" autocomplete="off">
                            {{-- <span class="text-danger" id="fromError"></span> --}}
                            @if ($errors->has('from_date'))
                            <span class='text-danger'>{{ $errors->first('from_date')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="to_date">To Date</label>
                            <input class="form-control" id="to_date" name="to_date" type="text" placeholder="Select Date" value="{{ old('to_date', $info->to_date) }}" autocomplete="off">
                            {{-- <span class="text-danger" id="toError"></span> --}}
                            @if ($errors->has('to_date'))
                            <span class='text-danger'>{{ $errors->first('to_date')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="male" value="male" {{ old('gender', $info->gender ?? '') === 'male' ? 'checked' : '' }} >
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="female" value="female" {{ old('gender', $info->gender ?? '') === 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="other" value="other" {{ old('gender', $info->gender ?? '') === 'other' ? 'checked' : '' }}>
                                <label class="form-check-label" for="other">Other</label>
                            </div><br>
                            {{-- <span class="text-danger" id="genderError"></span> --}}
                            @if ($errors->has('gender'))
                            <span class='text-danger'>{{ $errors->first('gender')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input status" type="radio" name="status" id="active" checked='checked' value="active" {{ old('status', $info->status ?? '') === 'active' ? 'checked' : '' }} >
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input status" type="radio" name="status" id="inactive" value="inactive" {{ old('status', $info->status ?? '') === 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                            {{-- <span class="text-danger" id="statusError"></span> --}}
                            @if ($errors->has('status'))
                            <span class='text-danger'>{{ $errors->first('status')}}</span>  
                            @endif
                        </div>
                        <div class='form-group mt-3'>
                            <label>Select Country</label><br>
                            <select id='country' class="form-control" name="country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country )
                                    {{-- <option value="{{$country->id}}">{{$country->country_name}}</option> --}}
                                    <option value="{{$country->id}}" {{ old('country', $info->country_id ?? '') == $country->id ? 'selected' : '' }}>{{$country->country_name}}</option>
                                    @endforeach
                            </select>
                            <span class="text-danger" id="countryError"></span>
                            @if ($errors->has('country'))
                                <span class='text-danger'>{{ $errors->first('country')}}</span>  
                            @endif
                        </div>
                        <div class='form-group mt-3'>
                            <label>Select State</label><br>
                            <select id='state' class="form-control" name="state">
 
                            </select>
                            <span class="text-danger" id="stateError"></span>
                            @if ($errors->has('state'))
                                <span class='text-danger'>{{ $errors->first('state')}}</span>  
                            @endif
                        </div>
                        <div class='form-group mt-3'>
                            <label>Select City</label><br>
                            <select id='city' class="form-control" name="city">
     
                            </select>
                            <span class="text-danger" id="cityError"></span>
                            @if ($errors->has('city'))
                                <span class='text-danger'>{{ $errors->first('city')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="hobby">Select Hobbies</label>
                            <select class="dropdown col-sm-2" style="width:200px" name="hobby[]" id='hobby' multiple>
                                @foreach ($hobbies as $row)
                                    @php
                                    // Retrieve old hobbies from a previous form submission (after a validation error)
                                    $oldHobbies = old('hobby');
                                    
                                    // Retrieve original hobbies IDs from $info
                                    $originalHobbies = $info->hobbies->pluck('hobby_id')->toArray();
                                    
                                    // Determine if the current hobby should be selected
                                    if (is_null($oldHobbies) && request()->isMethod('post')) {
                                        // First time form load, select original hobbies
                                        
                                        $selected = '';
                                    } elseif (is_null($oldHobbies) && request()->isMethod('get')) {
                                        // Form submission with cleared input, do not select any hobbies
                                        $selected = in_array($row->id, $originalHobbies) ? 'selected' : '';

                                    } else {
                                        // Form submission with existing input, check if hobby is in old input
                                        $selected = in_array($row->id, (array)$oldHobbies) ? 'selected' : '';
                                    }
                                    @endphp    
                                    <option value="{{$row->id}}" {{$selected}}>{{$row->hobby_name}}</option>
                                @endforeach
                            </select>
                            
                            @if($errors->has('hobby'))
                            <span class="text-danger">{{$errors->first('hobby')}}</span>
                            @endif 
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class='form-control' id="image" name='image' type="file" value="{{ old('image')}}">
                            {{-- <span class="text-danger" id="imageError"></span> --}}
                            @if ($errors->has('image'))
                            <span class='text-danger'>{{ $errors->first('image')}}</span><br>    
                            @endif
                            @if(isset($info->image))
                                <img src="{{url('public/products/'.$info->image)}}" height='100px' width='100px' alt="Current Image" class='mt-3'>
                            @endif 
                        </div>
                        <input type="hidden" name="id" value="{{ $info->id }}">

                        <button id='subbtn' type="submit" type="submit" name="button" class="btn btn-primary">Save Changes</button>
                        {{-- <button id='subbtn' type="submit" type="button" value="{{$title}}" name="button" class="btn btn-primary">{{$title}}</button> --}}
                        <a class="btn btn-danger" href="{{route('products.home')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="{{url('public/js/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

{{-- datepicker --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    // Method 1: This method shows all validations at a time
    // function validate_form(){ 
    //         var name = $('#name').val();
    //         var email = $('#email').val();
    //         var description = $('#description').val();
    //         var from_date = $('#from_date').val();
    //         var to_date = $('#to_date').val();
    //         // var gender = $('#gender').val();
    //         var gender = $('input[name="gender"]:checked').val(); // Correct way to get selected radio value
    //         var country = $('#country').val();
    //         var state = $('#state').val();
    //         var city = $('#city').val();
    //         var hobby = $('#hobby').val();
    //         var image = $('#image').val();

    //         var isValid = true;

    //         if (name.trim() == '') {
    //             $('#nameError').text('Name is required.');
    //             isValid = false;
    //         } else {
    //             $('#nameError').text('');
    //         }

    //         if (email.trim() == '') {
    //             $('#emailError').text('Email is required.');
    //             isValid = false;
    //         } else {
    //             $('#emailError').text('');
    //         }
            
           
    //         if (description.trim() == '') {
    //             $('#descriptionError').text('Description is required.');
    //             isValid = false;
    //         } else {
    //             $('#descriptionError').text('');
    //         }

    //         if (from_date.trim() == '') {
    //             $('#fromDateError').text('Date is required.');
    //             isValid = false;
    //         } else {
    //             $('#fromDateError').text('');
    //         }

    //         if (to_date.trim() == '') {
    //             $('#toDateError').text('Date is required.');
    //             isValid = false;
    //         } else {
    //             $('#toDateError').text('');
    //         }

    //         if (!gender) {
    //             $('#genderError').text('Gender is required.');
    //             isValid = false;
    //         } else {
    //             $('#genderError').text('');
    //         }

    //         if (country.trim() == '') {
    //             $('#countryError').text('Country is required.');
    //             isValid = false;
    //         } else {
    //             $('#countryError').text('');
    //         }

    //         if (!state || state.trim() == '') {
    //             $('#stateError').text('State is required.');
    //             isValid = false;
    //         } else {
    //             $('#stateError').text('');
    //         }

    //         if (!city || city.trim() == '') {
    //             $('#cityError').text('City is required.');
    //             isValid = false;
    //         } else {
    //             $('#cityError').text('');
    //         }

    //         if (!hobby || hobby.length === 0) {
    //             $('#hobbyError').text('Hobby is required.');
    //             isValid = false;
    //         } else {
    //             $('#hobbyError').text('');
    //         }

    //         if (image.trim() == '') {
    //             $('#imageError').text('Image is required.');
    //             isValid = false;
    //         } else {
    //             $('#imageError').text('');
    //         }

    //         // if (isValid == false) { 
    //         //     event.preventDefault(); // Prevent the form from submitting
    //         // }
    //         return isValid; // return false prevents form submission, return true allows it
    // };

    

    // Method 2: This method shows one validation at a time along with focus
    // function validate_form(){ 
    //     var name = $('#name').val();
    //         var email = $('#email').val();
    //     var description = $('#description').val();
    //     var from_date = $('#from_date').val();
    //     var to_date = $('#to_date').val();
    //     var gender = $('input[name="gender"]:checked').val(); // Correct way to get selected radio value
    //     var country = $('#country').val();
    //     var state = $('#state').val();
    //     var city = $('#city').val();
    //     var hobby = $('#hobby').val();
    //     var image = $('#image').val();

    //     if (name.trim() == '') {
    //         $('#nameError').text('Name is required.');
    //         $('#name').focus();
    //         return false;
    //     } else {
    //         $('#nameError').text('');
    //     }

    //     if (email.trim() == '') {
    //         $('#emailError').text('Email is required.');
    //         $('#email').focus();
    //         return false;
    //     } else {
    //         $('#emailError').text('');
    //     }

    //     if (description.trim() == '') {
    //         $('#descriptionError').text('Description is required.');
    //         $('#description').focus();
    //         return false;
    //     } else {
    //         $('#descriptionError').text('');
    //     }

    //     if (from_date.trim() == '') {
    //         $('#fromDateError').text('From date is required.');
    //         $('#from_date').focus();
    //         return false;
    //     } else {
    //         $('#fromDateError').text('');
    //     }

    //     if (to_date.trim() == '') {
    //         $('#toDateError').text('To date is required.');
    //         $('#to_date').focus();
    //         return false;
    //     } else {
    //         $('#toDateError').text('');
    //     }

    //     if (!gender) {
    //         $('#genderError').text('Gender is required.');
    //         $('input[name="gender"]').focus();
    //         return false;
    //     } else {
    //         $('#genderError').text('');
    //     }

    //     if (country.trim() == '') {
    //         $('#countryError').text('Country is required.');
    //         $('#country').focus();
    //         return false;
    //     } else {
    //         $('#countryError').text('');
    //     }

    //     if (!state || state.trim() == '') {
    //         $('#stateError').text('State is required.');
    //         $('#state').focus();
    //         return false;
    //     } else {
    //         $('#stateError').text('');
    //     }

    //     if (!city || city.trim() == '') {
    //         $('#cityError').text('City is required.');
    //         $('#city').focus();
    //         return false;
    //     } else {
    //         $('#cityError').text('');
    //     }

    //     if (!hobby || hobby.length === 0) {
    //         $('#hobbyError').text('Hobby is required.');
    //         $('#hobby').focus();
    //         return false;
    //     } else {
    //         $('#hobbyError').text('');
    //     }

    //     if (image.trim() == '') {
    //         $('#imageError').text('Image is required.');
    //         $('#image').focus();
    //         return false;
    //     } else {
    //         $('#imageError').text('');
    //     }

    //     return true; // return false prevents form submission, return true allows it
    // };

</script>
<script>
    $(function() {
        $("#from_date").datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                $("#to_date").datepicker("option", "minDate", selectedDate);
            }
        });
        
        $("#to_date").datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                $("#from_date").datepicker("option", "maxDate", selectedDate);
            }
        });
        
        new MultiSelectTag('hobby')

        });

    // $('#subbtn').click(function(event){
    //     var buttonValue = $(this).val();

    //     // Serialize the form data
    //     var formData = $("#form").serialize();
        
    //     // Include the button value in the data object
    //     formData += "&button=" + buttonValue;
    //     // console.log(formData);return false;
    //     // event.preventDefault();
        
    //     $.ajax({
    //         url:"{{route('products.store')}}",
    //         type:"POST",
    //         data:formData,
    //         success:function(response){
    //             if (response.success) {
    //                 // If the response indicates success, you can redirect the user to another page or perform any other action as needed
    //                 window.location.href = "{{ route('products.home') }}";
    //             } else {
    //                 // If the response indicates failure, display validation errors below the input fields
    //                 $.each(response.errors, function(key, value) {
    //                     // Find the input field with the corresponding name attribute and append the error message below it
    //                     $('[name="' + key + '"]').siblings('.text-danger').html(value);
    //                 });
    //             }
    //         }
    //     })
    // });

    // $('#country').change(function(event){ 
    //     var idCountry = $(this).val();
    //     $('#state').html('');

    //     $.ajax({
    //         url : "{{ route('fetch_state') }}",
    //         type : 'post',
    //         dataType: 'json',
    //         data: {
    //             country_id: idCountry, _token:"{{ csrf_token()}}"
    //         },
    //         success: function(response){
    //             // alert(response.status);
    //             $('#state').html('<option value="">Select State</option>');
    //             $.each(response.states, function(index, state){
    //                 $('#state').append('<option value="'+state.id+'">'+state.state_name+'</option>');
    //             });
    //             $('#city').html('<option value="">Select City</option>');

    //         }
    //     });

    // });

    // $('#state').change(function(event){ 
    //     var idState = $(this).val();
    //     // alert(country_id);
    //     $('#city').html('');

    //     $.ajax({
    //         url : "{{ route('fetch_city') }}",
    //         type : 'post',
    //         dataType: 'json',
    //         data: {
    //             state_id: idState, _token:"{{ csrf_token()}}"
    //         },
    //         success: function(response){
    //             // console.log(response);
    //             $('#city').html('<option value="">Select City</option>');
    //             $.each(response.cities, function(index, city){
    //                 $('#city').append('<option value="'+city.id+'">'+city.city_name+'</option>');
    //             });

    //         }
    //     });

    // });



    $(document).ready(function() {
        // var countrySelected = "{{ old('country') }}";
        // var stateSelected = "{{ old('state') }}";
        // var citySelected = "{{ old('city') }}";


        var countrySelected = "{{ old('country', $info->country_id ?? '') }}";
        var stateSelected = "{{ old('state', $info->state_id ?? '') }}";
        var citySelected = "{{ old('city', $info->city_id ?? '') }}";
    
        if(countrySelected) {
            fetchStates(countrySelected, stateSelected);
        }
        
        $('#country').change(function() {
            var idCountry = $(this).val();
            $('#state').html('');
            $('#city').html('');
            fetchStates(idCountry);
        });
        
        $('#state').change(function() {
            var idState = $(this).val();
            $('#city').html('');
            fetchCities(idState);
        });
        
        function fetchStates(idCountry, selectedState = '') {
            $.ajax({
                url : "{{ route('fetch_state') }}",
                type : 'post',
                dataType: 'json',
                data: {
                    country_id: idCountry, _token:"{{ csrf_token()}}"
                },
                success: function(response) {
                    $('#state').html('<option value="">Select State</option>');
                    $('#city').html('<option value="">Select City</option>');

                    $.each(response.states, function(index, state) {
                        var selected = (selectedState == state.id) ? 'selected' : '';
                        $('#state').append('<option value="'+state.id+'" '+selected+'>'+state.state_name+'</option>');
                    });
                    
                    if(selectedState) {
                        fetchCities(selectedState, citySelected);
                    }
                }
            });
        }
        
        function fetchCities(idState, selectedCity = '') {
            $.ajax({
                url : "{{ route('fetch_city') }}",
                type : 'post',
                dataType: 'json',
                data: {
                    state_id: idState, _token:"{{ csrf_token()}}"
                },
                success: function(response) {
                    $('#city').html('<option value="">Select City</option>');
                    $.each(response.cities, function(index, city) {
                        var selected = (selectedCity == city.id) ? 'selected' : '';
                        $('#city').append('<option value="'+city.id+'" '+selected+'>'+city.city_name+'</option>');
                    });
                }
            });
        }
    });

</script>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('image_base64').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</html>