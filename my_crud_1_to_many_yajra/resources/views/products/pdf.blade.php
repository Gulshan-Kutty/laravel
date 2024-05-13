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
    <table border="1px">
        <thead>
           
            <tr>
               <th colspan="6" align="center" style="background: #ffffb3; border:1px solid black"><b>Product Details</b></th>
            </tr>
            <tr>
                <th style="border:1px solid black; background: #ccffff"><b>Name</b></th>
                <th style="border:1px solid black; background: #ccffff"><b>Description</b></th>
                <th style="border:1px solid black; background: #ccffff"><b>From_date</b></th>
                <th style="border:1px solid black; background: #ccffff"><b>To_date</b></th>
                <th style="border:1px solid black; background: #ccffff"><b>Countries</b></th>
                <th style="border:1px solid black; background: #ccffff"><b>Image</b></th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td style="border:1px solid black">{{ $product->name }}</td>
                <td style="border:1px solid black">{{ $product->description }}</td>
                <td style="border:1px solid black">{{ $product->from_date }}</td>
                <td style="border:1px solid black">{{ $product->to_date }}</td>
                <td style="border:1px solid black">{{ $product->countries->pluck('country.country_name')->implode(', ')}}</td>
                <td style="border:1px solid black">{{url('public/users/'.$product->image)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>