@extends('layout.head')
@extends('layout.footer')
@section('main')
{{-- <?php print_r($join);  ?> --}}

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" >
      <a class="navbar-brand" href="{{route('country.index')}}">Country CRUD</a>
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
    
    
    <div><a href="{{route('state.index')}}" class="btn btn-info btn-sm">State view</a>&nbsp;<a href="{{route('user.index')}}" class="btn btn-info btn-sm">User view</a>&nbsp;<a href="{{route('city.index')}}" class="btn btn-info btn-sm">City view</a>&nbsp;<a href="{{route('country.jquery_tuto')}}" class="btn btn-info btn-sm">jquery</a><a href="{{route('country.create')}}" class="btn btn-success float-right mt-2 mb-2" style="float: right" >Create Country</a>&nbsp;&nbsp;&nbsp;
    </div>
    <br><br>
    <table class="table" data-aos="fade-right">
      <thead>
        <tr>
          <th scope="col">Sr No.</th>
          <th scope="col">Country Name</th>
          <th scope="col">Country Code</th>
          <th scope="col">State </th>
          <th scope="col">Currency</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        
          @foreach ($country as $row)
              {{-- @php print_r($row);exit; @endphp --}}
        <tr>
          <th>{{$loop->index+1}}</th>
          <td>{{$row->country_name}}</td>
          <td>{{$row->country_code}}</td>
          <td>{{$row->state_name}}</td>
          <td>{{$row->currency}}</td>
        
          <td>{{ucfirst($row->status)}}</td>
          <td><a href="{{route('country.show',base64_encode($row->id))}}" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
            <a href="{{route('country.edit',base64_encode($row->id))}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
            <a href="{{route('country.delete',base64_encode($row->id))}}"  onclick="return confirm('Want to delete this country??')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            {{-- <a href="{{url('https://www.google.com/maps/place/'.$row->country_name)}}" target="blank" class="btn btn-info btn-sm">Map</a> --}}
        </td>
          
        </tr>

        @endforeach
      </tbody>
    </table>
   
</div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection
@section('footer')
@endsection 