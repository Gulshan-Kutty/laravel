<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
    <title>Export</title>
</head>
<body>
    <table class='table table-bordered'>
        <thead>
            <tr>
               <th colspan="9" align="center" style="background: #ffffb3"><b>Product Details</b></th>
            </tr>
        <tr>
            <th style="background: #ccffff"><b>Name</b></th>
            <th style="background: #ccffff"><b>Description</b></th>
            <th style="background: #ccffff"><b>From_date</b></th>
            <th style="background: #ccffff"><b>To_date</b></th>
            <th style="background: #ccffff"><b>Countries</b></th>
            <th style="background: #ccffff"><b>Image</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->from_date }}</td>
                <td>{{ $product->to_date }}</td>
                <td>{{ $product->countries->pluck('country.country_name')->implode(', '); }}</td>
                <td>{{url('public/users/'.$product->image)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>