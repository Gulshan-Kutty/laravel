<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-6">
           <div class="card mt-2 p-3">
            Country Name :<span>{{ucfirst($cdata->country_name)}}</span><br>
    
            Country Code :<span>{{ucfirst($cdata->country_code)}}</span>

            Currency :<span>{{ucfirst($cdata->currency)}}</span>

            Status :<span>{{ucfirst($cdata->status)}}</span>
            
            </div><br><a href="{{route('country.index')}}" class="btn btn-success btn-sm">Home</a>
        </div>
    </div>
</div>

   
</body>
</html>