<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5 col-8">
        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>Index Page</div>
                <div> <a href="{{ route('mongodb.create') }}" class="btn btn-primary btn-sm">Create</a></div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            {{-- <th>Id</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                {{-- <td>{{$value->id}}</td> --}}
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>{{ $value->address }}</td>
                                <td>
                                    <a href="{{ route('mongodb.show',$value->id) }}" class="btn btn-success btn-sm">Show</a>
                                    <a href="{{ route('mongodb.edit',$value->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('mongodb.destroy',$value->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
       <script>
        // Get the element with the "alert" class
        var alertElement = document.querySelector('.alert');

        // Apply setTimeout function to the alert element
        setTimeout(function() {
            // Hide the alert after 3 seconds
            alertElement.style.display = 'none';
        }, 3000);
    </script>
</body>

</html>
