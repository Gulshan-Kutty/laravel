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
                <div>Edit Page</div>
                <div> <a href="{{ route('mongodb.index') }}" class="btn btn-primary btn-sm">&larr; Index</a></div>
            </div>
            <div class="card-body">
                <form action="{{ route('mongodb.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-text" value="{{ $user->name }}"
                            placeholder="Enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-text" value="{{ $user->email }}"
                            placeholder="Enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-text"
                            value="{{ $user->password }}" placeholder="Enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control form-text" value="{{ $user->mobile }}"
                            placeholder="Enter ,mobile">
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control form-text" value="{{ $user->address }}"
                            placeholder="Enter name">
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>

                </form>
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
