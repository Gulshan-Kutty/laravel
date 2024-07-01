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
                    <form id='form' action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nameeee</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Product Name" value="{{ old('name', $info->name ?? '') }}">
                            {{-- <span class="text-danger" id="nameError"></span> --}}
                            {{-- @if ($errors->has('name'))
                            <span class='text-danger'>{{ $errors->first('name')}}</span>  
                            @endif  --}}
                            @error('name')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class='form-control' id="description" name="description" placeholder="Product Description" cols="30" rows="10">{{old('description' , $info->description ?? '')}}</textarea>
                            {{-- <span class="text-danger" id="descriptionError"></span> --}}
                            @if ($errors->has('description'))
                            <span class='text-danger'>{{ $errors->first('description')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input class="form-control" id="from_date" name="from_date" type="text" placeholder="Select Date" value="{{ old('from_date', $info->from_date ?? '') }}" autocomplete="off">
                            {{-- <span class="text-danger" id="fromError"></span> --}}
                            @if ($errors->has('from_date'))
                            <span class='text-danger'>{{ $errors->first('from_date')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="to_date">To Date</label>
                            <input class="form-control" id="to_date" name="to_date" type="text" placeholder="Select Date" value="{{ old('to_date', $info->to_date ?? '') }}" autocomplete="off">
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
                        {{-- <div class="form-group">
                            <label for="hobby">Select Hobbies</label>
                            <select class="dropdown col-sm-2" style="width:200px" name="hobby[]" id='hobby' multiple>
                                @foreach ($data1 as $row) --}}
                                    {{-- Check if $info is defined and if the current hobby is associated with the product being edited --}}
                                    {{-- @php
                                        $selected = isset($info) && in_array($row->id, $info->hobbies->pluck('hobby')->pluck('id')->toArray()) ? 'selected' : ''; //  This is a ternary operator used to determine the value of $selected. It checks if $info is set and if the current $row->id is present in the list of countries associated with $info. If the condition is true, the string 'selected' is assigned to $selected, indicating that the option should be pre-selected. Otherwise, an empty string is assigned.
                                    @endphp
                                    <option value="{{$row->id}}" {{$selected}}>{{$row->hobby_name}}</option>
                                @endforeach
                            </select> 
                            @if($errors->has('hobby'))
                            <span class="text-danger">{{$errors->first('hobby')}}</span>
                            @endif 
                        </div> --}}
                        <div class="form-group">
                            <label for="hobby">Select Hobbies</label>
                            <select class="dropdown col-sm-2" style="width:200px" name="hobby[]" id='hobby' multiple>
                                @foreach ($data1 as $row)
                                    {{-- Check if $info is defined and if the current hobby is associated with the product being edited --}}
                                    @php
                                        $selected = isset($info) && in_array($row->id, $info->hobbies->pluck('hobby')->pluck('id')->toArray()) ? 'selected' : ''; //  This is a ternary operator used to determine the value of $selected. It checks if $info is set and if the current $row->id is present in the list of countries associated with $info. If the condition is true, the string 'selected' is assigned to $selected, indicating that the option should be pre-selected. Otherwise, an empty string is assigned.
                                    @endphp     
                                    @if ($selected)
                                        <option value="{{$row->id}}" {{$selected}}>
                                            {{$row->hobby_name}}
                                        </option>
                                    @else
                                        <option value="{{$row->id}}" {{ in_array($row->id, old('hobby', [])) ? 'selected' : '' }}>
                                            {{$row->hobby_name}}
                                        </option>                                   
                                     @endif
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
                        {{-- <input type="hidden" name="id" value="{{ $info->id ?? '' }}"> --}}

                        <button id='subbtn' type="submit" value="{{$title}}" name="button" class="btn btn-primary">{{$title}}</button>
                        {{-- <button id='subbtn' type="button" value="{{$title}}" name="button" class="btn btn-primary">{{$title}}</button> --}}
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
        // function validate_form(){ 
        //         var name = $('#name').val();
        //         var description = $('#description').val();
        //         var image = $('#image').val();
        //         var isValid = true;

        //         if (name.trim() == '') {
        //             $('#nameError').text('Name is required.');
        //             isValid = false;
        //         } else {
        //             $('#nameError').text('');
        //         }

        //         if (description.trim() == '') {
        //             $('#descriptionError').text('Description is required.');
        //             isValid = false;
        //         } else {
        //             $('#descriptionError').text('');
        //         }

        //         if (image.trim() == '') {
        //             $('#imageError').text('Image is required.');
        //             isValid = false;
        //         } else {
        //             $('#imageError').text('');
        //         }
        //         // alert(isValid);
        //         if (!isValid) {  // if isValid=='true'
        //             event.preventDefault(); // Prevent the form from submitting
        //         }
        // };

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


    </script>
</html>