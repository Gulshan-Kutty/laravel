<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   
    <title>Document</title>
</head>
<body>
  @if ($message= Session::get('success'))
  <div class="alert alert-success alert-block" >
        <strong>{{ $message }}</strong>
  </div>
@elseif ($message= Session::get('error'))
<div class="alert alert-danger alert-block" >
  <strong>{{ $message }}</strong>
</div>
@endif
@php
    // print_r(phpinfo());
@endphp
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <a class="navbar-brand" href="{{route('country.index')}}">User CRUD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('country.index')}}">Home</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('logout.flush')}}">Logout</a>
                </li>
               </ul>
             </div>
          </nav>
          {{env('PUSPA')}}
          <br>
        ID of the user is = <?php print_r(Session::get('id')); ?>
        <a href="{{route('user.mailpage')}}" class="btn btn-success">Send Mail</a>
          &nbsp;<a href="{{route('user.create')}}" class="btn btn-success float-right mt-2 mb-2" style="float: right" >Create User</a>&nbsp;
          <div>
            <h3>Import data</h3>
            <a href="{{route('user.import_dummy')}}">Download dummy excel</a>
            <form action="{{route('user.import')}}" method="POST" enctype="multipart/form-data">
              @csrf
              
            <input type="file" name="file">
            <button type="submit" class="btn btn-success">submit</button>
            @if ($errors->has('file'))
              <span class="text-danger">{{$errors->first('file')}}</span>
              @endif 
          </form>
          <br>
          <form action="{{route('user.export_d')}}" method="POST" enctype="multipart/form-data">
            @csrf 
            <label for="from">From date</label>
            <input type="text" id="from" name="from" autocomplete="off">
            <label for="to">To date</label>
            <input type="text" id="to" name="to"autocomplete="off">
            <button type="submit" class="btn btn-success" >Export</button>
            @if ($errors->has('from'))
            <span class="text-danger">{{$errors->first('from')}}</span>
            @endif 
            @if ($errors->has('to'))
            &nbsp;<span class="text-danger">{{$errors->first('to')}}</span>
            @endif 
            {{-- &nbsp;<a href="{{route('user.export_d')}}" class="btn btn-success float-right mt-2 mb-2" id="date">export d</a>&nbsp; --}}
          </form>
            {{-- &nbsp;<a href="{{route('user.export')}}" class="btn btn-success float-right mt-2 mb-2">Export</a>&nbsp; --}}
            &nbsp;<a href="{{route('user.pdf',)}}" class="btn btn-success float-right mt-2 mb-2">Download pdf&darr;</a>&nbsp;
            &nbsp;<a href="{{route('user.multi_img',)}}" class="btn btn-success float-right mt-2 mb-2">Multiple img</a>&nbsp;
        
          </div>

<table class="table table-bordered data-table" id="table" data-aos="fade-right">
  <thead>
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
    <th width="150px">Action</th>
    
    {{-- <tr> --}}
        {{-- @foreach ($data as $row )
        <td>{{$loop->index+1}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->email}}</td>
        <td>{{$row->mobile}}</td>
        <td>{{$row->gender}}</td>
        <td><img src="{{url('public/users/'.$row->image)}}" class="rounded-circle" width='50' height="50" /></td> --}}
        {{-- <td>{{ucfirst($row->city_name)}}</td> --}}
        {{-- <td>{{ucfirst($row->country_name)}}</td>
        <td>{{ucfirst($row->state_name)}}</td>
        <td>{{ucfirst($row->city_name)}}</td>
        <td>{{ucfirst($row->status)}}</td> --}}
        {{-- <td><a href="{{route('user.show',base64_encode($row->id))}}" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
              <a href="{{route('user.delete',base64_encode($row->id))}}"  onclick="return confirm('Want to delete this country??')" ><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
            {{-- <a href="{{url('https://www.google.com/maps/place/'.$row->country_name)}}" target="blank" class="btn btn-info btn-sm">Map</a> --}}
        {{-- </td> --}}
        
        
    {{-- </tr> --}}
    {{-- @endforeach --}}
  </thead>
    <tbody>
    </tbody>
</table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
  $(document).ready(function(){ 
     $(".alert").fadeTo(1000, 500).slideUp(500, function(){
         $(".alert").slideUp(600);
         setTimeout(window.location.href = "{{route('user.index')}}", 1000);
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
      $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.yajra') }}",
            columns: [

                
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mobile', name: 'mobile'},
                {data: 'gender', name: 'gender'},
                {data: 'image', name: 'image'},
                {data: 'country', name: 'Country'},
                {data: 'state', name: 'state'},
                {data: 'city', name: 'City'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[ 0, 'desc' ]],
            lengthMenu: [[5,10,15,20,-1],
                        [5,10,15,20,'All']],
        });
          
      });
    </script>


  <script>
     function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
     }
     function statuschange(status,id) {
      var sta=status;
      var id=id;
      // alert(sta);
      $.ajax({
        url:"{{ route('user.status') }}",
        type:"POST",
        data: { id:id,status:sta,_token:"{{csrf_token()}}"},
        success:function(result){
          $('.data-table').DataTable().ajax.reload();
        }
      })

     }
  </script>


  {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#from" ).datepicker({
        numberOfMonths: 1,
          dateFormat:"yy-mm-dd",
         onSelect:function(selectdate){
          var dt=new Date(selectdate);
          dt.setDate(dt.getDate()+1)
          $('#to').datepicker('option','mindate',dt);
         }
        });
        $( "#to" ).datepicker({
        numberOfMonths: 1,
          dateFormat:"yy-mm-dd",
         onSelect:function(selectdate){
          var dt=new Date(selectdate);
          dt.setDate(dt.getDate()-1)
          $('#from').datepicker('option','maxdate',dt);
         }
        });
       
  } );
  </script>
</body>
</html>