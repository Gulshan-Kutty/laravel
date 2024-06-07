<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <script src="{{url('public/js/masters/country.js')}}"></script>


    {{-- Yajra Datatables related scripts and links --}}
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="{{url('public/js/jquery-3.7.1.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


    <style>
        .navbar {
            height: 80px; /* Change the height value as needed */
        }
        /* .nav-link{
            display: inline-block;
        }
     */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('countries.list')}}">Country</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">State</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">City</a>
          </li>

        </ul>
    </nav>
    <div class="container">
        <h3>Import data</h3>
        <form action="{{route('countries.import')}}" method="POST" enctype="multipart/form-data" id="importForm" >
          @csrf
        <input type="file" name="file" id="file">
        <span id="fileError" class="text-danger"></span>

        <button type="submit" class="btn btn-success" onclick="return fileUpload()">Import</button>
        {{-- onclick="return fileUpload()":
        When the button is clicked, the fileUpload function is executed.
        The return keyword ensures that the value returned by fileUpload (either true or false) is passed back to the onclick event handler.
        If fileUpload returns false, the default form submission is prevented. If it returns true, the form submission proceeds as normal. --}}
      </form>
        <div class="row">
            <h2 class='mt-3 ml-3'>Countries List</h2>
            <button type='submit' class='btn btn-primary m-3 ml-auto ' onclick="window.location='{{ route('countries.create')}}'">Create Country</button>
        </div>
        <table class='table table-bordered datatable mt-4'>
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Country Name</th>
                </tr>
            </thead>
        </table>
        
    </div>
    </body>
    
    {{-- Yajra Datatables related code --}}
    <script type="text/javascript">
        $(function () {
            
          var table = $('.datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('countries.ajax_country') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'country', name: 'country'},
          ],

          });
            
        });
      </script>
    </html>
