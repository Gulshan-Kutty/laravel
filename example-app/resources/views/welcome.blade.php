<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome to my application</h2>
    {{-- <button type='submit' onclick="window.location='/nextpage'">Click</button> --}}
    {{-- <button type='submit' onclick="window.location='{{ route('new-page') }}'">Click</button> --}}
    <button type='submit' onclick="window.location='{{ route('compact-page') }}'">Click</button>
</body>
</html>