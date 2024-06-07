<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <title>Create Page</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mt-3">Create Country</h3>
                <div class="card mt-3 p-3">
                    <form id='form' action="{{route('countries.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Country Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Product Name" value="{{ $info->name ?? old('name')}}">
                        </div>
                        <button id='subbtn' type="submit" class="btn btn-primary">Create</button>
                        <a class="btn btn-danger" href="{{route('countries.list')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>