@extends('layout.head')
@section('main')
<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6">
               <div class="card mt-2 p-3">

                State ID :<span>{{ucfirst($data->id)}}</span><br>

                State Name :<span>{{ucfirst($data->state_name)}}</span><br>

                Status :<span>{{ucfirst($data->status)}}</span>
                
                </div><br><a href="{{route('state.index')}}" class="btn btn-success btn-sm">Home</a>
            </div>
        </div>
    </div>
@endsection
</body>

</html>