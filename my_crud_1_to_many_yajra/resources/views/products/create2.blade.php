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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
 
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3 p-3">
                    <form id = 'form' action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Product Name" value="{{ $info->name ?? old('name')}}">
                            {{-- <span class="text-danger" id="nameError"></span> --}}
                            @if ($errors->has('name'))
                            <span class='text-danger'>{{ $errors->first('name')}}</span>  
                            @endif 
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class='form-control' id="description" name="description" placeholder="Product Description" cols="30" rows="10">{{$info->description ?? old('description')}}</textarea>
                            {{-- <span class="text-danger" id="descriptionError"></span> --}}
                            @if ($errors->has('description'))
                            <span class='text-danger'>{{ $errors->first('description')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input class="form-control" id="from_date" name="from_date" type="text" placeholder="Select Date" value="{{ $info->from_date ?? old('from_date')}}">
                            {{-- <span class="text-danger" id="fromError"></span> --}}
                            @if ($errors->has('from_date'))
                            <span class='text-danger'>{{ $errors->first('from_date')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="to_date">To Date</label>
                            <input class="form-control" id="to_date" name="to_date" type="text" placeholder="Select Date" value="{{ $info->to_date ?? old('to_date')}}">
                            {{-- <span class="text-danger" id="toError"></span> --}}
                            @if ($errors->has('to_date'))
                            <span class='text-danger'>{{ $errors->first('to_date')}}</span>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Select Countries</label>
                            {{-- <select class="dropdown col-sm-2 " style="width:200px" name="multi[]" id='multi' multiple>
                                
                                @foreach ($data1 as $row )
                                <option value="{{$row->id}}">{{$row->country_name}}</option>
                                @endforeach
                                
                            </select>  --}}
                         
                            <select class="dropdown col-sm-2" style="width:200px" name="multi[]" id='multi' multiple>
                                @foreach ($data1 as $row)
                                    {{-- Check if $info is defined and if the current country is associated with the product being edited --}}
                                    @php
                                        $selected = isset($info) && in_array($row->id, $info->countries->pluck('country')->pluck('id')->toArray()) ? 'selected' : ''; //  This is a ternary operator used to determine the value of $selected. It checks if $info is set and if the current $row->id is present in the list of countries associated with $info. If the condition is true, the string 'selected' is assigned to $selected, indicating that the option should be pre-selected. Otherwise, an empty string is assigned.
                                    @endphp
                                    <option value="{{$row->id}}" {{$selected}}>{{$row->country_name}}</option>
                                @endforeach
                            </select> 
                            @if($errors->has('multi'))
                            <span class="text-danger">{{$errors->first('multi')}}</span>
                            @endif 
    
                        </div>   
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class='form-control' id="image" name='image' type="file">
                            {{-- <span class="text-danger" id="imageError"></span> --}}
                            @if ($errors->has('image'))
                            <span class='text-danger'>{{ $errors->first('image')}}</span><br>    
                            @endif
                            @if(isset($info->image))
                                <img src="{{url('public/products/'.$info->image)}}" height='100px' width='100px' alt="Current Image" class='mt-3'>
                            @endif 
                        </div>
                        <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                        <button id='subbtn' type="submit" value="{{$title}}" name="button" class="btn btn-primary">{{$title}}</button>
                        <a class="btn btn-danger" href="{{route('products.home')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

    <script src="{{url('public/js/jquery-3.7.1.min.js')}}"></script>
   
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
            
            new MultiSelectTag('multi')

         });

        $('#subbtn').click(function(event){
                formdata=$("#form").serialize();
                $.ajax({
                    url:"{{route('products.store')}}",
                    type:"POST",
                    data:{formdata,_token:"{{ csrf_token()}}"},
                    success:function(res){
                        window.location.href ="{{route('products.home')}}";
                    }
                })
                });


    </script>
</html>