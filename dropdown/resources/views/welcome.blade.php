<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
</head>
<body>
    <button type='submit' class='btn btn-primary mt-3 ml-auto mr-3' onclick="window.location='{{ route('jquery')}}'">Jquery</button>
    <div class="container mt-4">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <h3>Dependent Dropdown</h3>
               <form action="">
                <div class='form-group mb-3'>
                    <select id='country' class="form-control" name="country">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country )
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class='form-group mb-3'>
                    <select id='state' class="form-control" name="state">
                    </select>
                </div>
                <div class='form-group mb-3'>
                    <select id='city' class="form-control" name="city">
                    </select>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script>
      
            $('#country').change(function(event){  // used different approach here
                alert('hello');
                var idCountry = $(this).val();
                // alert('Hello');
                $('#state').html('');

                $.ajax({
                    url : "{{ route('fetch_state') }}",
                    type : 'post',
                    dataType: 'json',
                    data: {
                        country_id: idCountry, _token:"{{ csrf_token()}}"
                    },
                    success: function(response){
                        // alert(response.status);
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
                    success: function(response){
                        // console.log(response);
                        $('#city').html('<option value="">Select City</option>');
                        $.each(response.cities, function(index, city){
                            $('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
                        });

                    }
                });

            });
    </script>
</body>
</html>
