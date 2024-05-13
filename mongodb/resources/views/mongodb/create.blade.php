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

    <div class="container mt-5 col-6">
        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>Create Page</div>
                <div> <a href="{{ route('mongodb.index') }}" class="btn btn-primary btn-sm">&larr; Index</a></div>
            </div>            
            <div class="card-body">
                <form action="{{ route('mongodb.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-text" placeholder="Enter Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-text" placeholder="Enter Email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-text" placeholder="Enter Password">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control form-text" placeholder="Enter Mobile">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control form-text" placeholder="Enter Address">
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>



                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
