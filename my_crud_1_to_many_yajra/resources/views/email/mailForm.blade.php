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
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Send mail</h1>
                </div>
                <div class="card-body">
                    {{-- @if ($message= Session::get('success'))
                    <div class="alert alert-success alert-block" id="successMessage">
                    <strong>{{ $message }}</strong>
                    </div> 
                    @endif 
                    @if ($message= Session::get('error'))
                    <div class="alert alert-danger alert-block" id="successMessage">
                    <strong>{{ $message }}</strong>
                    </div> 
                    @endif    --}}
                    <form action="{{route('sendMail')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="form-label">CC</label>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 12px;color:rgb(254, 92, 92)">NOTE:Please enter emails seperated by ',' and avoid spaces</span>
                            <input type="text" name="cc" class="form-control" placeholder="Enter cc">
                        </div>
                        <div class="mb-6">
                            <label for="text" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter subject" required>
                        </div>
                        <div class="mb-6">
                            <label for="text" class="form-label" >Attachment</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="mb-6">
                            <label for="text" class="form-label" >Content</label>
                            <textarea name="body" id="editor" placeholder="Enter the Description"></textarea>
                        </div>
                        <div class="mb-6">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Mail</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="mb-6">
                        <div class="d-grid">
                            <a href="{{route('products.home')}}" class="btn btn-success">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){ 
           $(".alert").fadeTo(1000, 500).slideUp(500, function(){
               $(".alert").slideUp(600);
               setTimeout(window.location.href = "{{route('mailForm')}}", 1000);
             });
            
        })
        $(document).ready(function(){ 
           $(".fade").fadeTo(3000, 200);
            
        })
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ),{
                    ckfinder:{
                        
                        uploadUrl:'{{route('sendMail', ['_token' => csrf_token()]) }}'
                    }
                } )
                .then( editor =>{
                    console.log(editor);
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
        {{-- <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('body', {
                filebrowserUploadUrl: "{{route('user.mail', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script> --}}
</body>
</html>