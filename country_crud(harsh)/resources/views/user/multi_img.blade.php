<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">

    <title>Document</title>
</head>
<body>
    <div class="container">

        <h1>multi img select</h1>

        <div>
            <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <span>Please select multiple img</span>
            <input type="file" name="images[]" id="images" multiple>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route("user.img_data") }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        alert('Images uploaded successfully!');
                        // Handle success response
                    },
                    error: function (xhr, status, error) {
                        alert('Error uploading images: ' + error);
                        // Handle error response
                    }
                });
            });
        });
    </script>
</body>
</html>