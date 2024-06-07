<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-10 text-center">
                <h2>Ajax Crud</h2>
                <div class="form-data">
                    <table class="table" >

                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>status</th>
                        <th>Action</th>
                        <tr>
                            @foreach ($data as $row )
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{$row->gender}}</td>
                            <td><img src="{{url('public/users/'.$row->image)}}" class="rounded-circle" width='50' height="50" /></td>
                            {{-- <td>{{ucfirst($row->city_name)}}</td> --}}
                            <td>{{ucfirst($row->country_name)}}</td>
                            <td>{{ucfirst($row->state_name)}}</td>
                            <td>{{ucfirst($row->city_name)}}</td>
                            <td>{{ucfirst($row->status)}}</td>
                            <td><a href="{{route('user.show',base64_encode($row->id))}}" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a href="{{route('user.update',base64_encode($row->id))}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a href="{{route('user.delete',base64_encode($row->id))}}"  onclick="return confirm('Want to delete this country??')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                {{-- <a href="{{url('https://www.google.com/maps/place/'.$row->country_name)}}" target="blank" class="btn btn-info btn-sm">Map</a> --}}
                            </td>
                            
                            
                        </tr>
                        @endforeach
                    </table>

                    <h5>create user</h5>
                    <div class="form-group">
                        <div class="errmsg"></div>
                            <label for="name">Name</label>
                            <input type="text" class="from-control" name="name" id="name" placeholder="name">
                            
                            <label for="name">Email</label>
                            <input type="text" class="from-control" name="email" id="email" placeholder="email">
                            <button type="submit" class="btn btn-success adduser">Submit</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>



        // alert();
        $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $(document).on('click','.adduser',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            
            $.ajax({
                url:"{{route('user.store')}}",
                method:"POST",
                data:{name:name,email:email},
                success:function(res){

                }
                error:function(err){

                }
            });
        })

    </script>
    <script>
         
    </script>
</body>
</html>