<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/css/bootstrap-toaster.min.css')}}">
    {{-- datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    @php
        print_r(Session::get('success'));
    @endphp
    @if ($message= Session::get('success'))
      <div class="alert alert-success alert-block" id="successMessage">
         <strong>{{ $message }}</strong>
      </div>
      @endif
    @php
        // print_r($data1->toArray());exit;
    @endphp
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('products.home')}}">Homepage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('logout') }}">Logout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{route('mailForm')}}" >Send Mail</a>
        </li>
        </ul>
    </nav>
    <div class="container">
        <h3>Import data</h3>
        <form action="{{route('products.import')}}" method="POST" enctype="multipart/form-data" id="importForm" >
          @csrf
        <input type="file" name="file" id="file">
        {{-- @if($errors->has('file'))
          <span class="text-danger">{{$errors->first('file')}}</span>
          @endif  --}}
        <span id="fileError" class="text-danger"></span>

        <button type="submit" class="btn btn-success">Import</button>
      </form>
      <br>
        <form class='mt-2' action="{{route('products.export')}}" method="POST" id="exportForm">
          @csrf 
          <label for="from">From date</label>
          <input type="text" id="from" name="from" autocomplete="off">
          {{-- @if($errors->has('from'))
          <span class="text-danger">{{$errors->first('from')}}</span>
          @endif  --}}
          <span id="fromError" class="text-danger"></span>

          <label for="to">To date</label>
          <input type="text" id="to" name="to"autocomplete="off">
          {{-- @if($errors->has('to'))
          <span class="text-danger">{{$errors->first('to')}}</span>
          @endif  --}}
          <span id="toError" class="text-danger"></span>

          <button type="submit" class="btn btn-success" >Export Excel</button>
          &nbsp;<a href="{{route('products.pdf',)}}" class="btn btn-success mt-2 mb-2">Download pdf</a>&nbsp;

          {{-- &nbsp;<a href="{{route('user.export_d')}}" class="btn btn-success float-right mt-2 mb-2" id="date">export d</a>&nbsp; --}}
        </form>
        <div class="row">
            <h2 class='mt-3 ml-3'>Products List</h2>
            <button type='submit' class='btn btn-primary m-3 ml-auto ' onclick="window.location='{{ route('products.create')}}'">Create Product</button>

        </div>

        {{-- accessing global varibale we defined in .env file--}}
        {{-- {{env('test')}}  --}}

        {{-- Yajra Datatable related code --}}
        <table class='table table-bordered datatable mt-4'>
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Gender</th>
                    <th>Country</th>
                    <th>Image</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
    </body>

    {{-- datepicker --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    {{-- Yajra Datatables related code --}}
    <script type="text/javascript">
        $(function () {
            
          var table = $('.datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('products.ajax_product') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'description', name: 'description'},
                  {data: 'from_date', name: 'from_date', orderable: false, searchable: false},
                  {data: 'to_date', name: 'to_date', orderable: false, searchable: false},
                  {data: 'gender', name: 'gender'},
                  {data: 'country', name: 'country'},
                  {data: 'image', name: 'image'},
                  {data: 'action', name: 'action'},
                  {
                    // Create status button dynamically
                    data: 'status',
                    name: 'status',
                    render: function (data, type, full, meta) {
                        var statusButton = "<button class='btn btn-sm " + (data === 'active' ? 'btn-success' : 'btn-danger') + " status-toggle' data-product-id='" + full.id + "' data-status='" + data + "'>" + data + "</button>";
                        return statusButton;
                    }
                }
              ],

              order:[[1, 'desc']],
              lengthMenu: [[4,3,2,-1], ['four','three','two','All']],

            // The first inner array [2,3,4,-1] defines the options available for the length menu. These are the numbers of records to display per page. -1 typically represents an option to display all records.
            // The second inner array ['two','three','four','All'] defines the labels corresponding to the options in the first array. So, instead of showing the numbers directly in the length menu, it will display these labels. 'All' is usually used to represent the option to display all records.
            //   name corresponds to the database table column name, and it's used by DataTables for server-side processing tasks like sorting and filtering.
          });
            
        });
      </script>

      <script>
          $(function() {
            $("#from").datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(selectedDate) {
                    $("#to").datepicker("option", "minDate", selectedDate);
                }
            });
            
            $("#to").datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(selectedDate) {
                    $("#from").datepicker("option", "maxDate", selectedDate);
                }
            });

            $("#exportForm").submit(function(event) {
                var isValid = true;

                // Check if from date is empty
                if ($("#from").val() === '') {
                    $("#fromError").text("Please select a from date.");
                    isValid = false;
                } else {
                    $("#fromError").text("");
                }

                // Check if to date is empty
                if ($("#to").val() === '') {
                    $("#toError").text("Please select a to date.");
                    isValid = false;
                } else {
                    $("#toError").text("");
                }

                // Prevent form submission if validation fails
                if (isValid == false) {
                    event.preventDefault();
                }
            });

            $("#importForm").submit(function(event) {
                var isValid = true;

                // Check if from date is empty
                if ($("#file").val() === '') {
                    $("#fileError").text("Please upload a file");
                    isValid = false;
                } else {
                    $("#fileError").text("");
                }

                // Prevent form submission if validation fails
                if (isValid == false) {
                    event.preventDefault();
                }
            });

            // code for status update
            $(document).on('click', '.status-toggle', function () {
            var productId = $(this).data('product-id');
            var newStatus = $(this).data('status') === 'active' ? 'inactive' : 'active';

            $.ajax({
                url: "{{ route('products.update_status') }}",
                type: "POST",
                data: {
                    productId: productId,
                    newStatus: newStatus,
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {

                        $('.datatable').DataTable().ajax.reload();
                }
       
            });
        });

    
        });
      </script>
      
    <script>
    $(document).ready(function(){ 
        $(".alert").fadeTo(1000, 500).slideUp(500, function(){
            $(".alert").slideUp(600);
            setTimeout(window.location.href = "{{route('products.home')}}", 1000);
            });   
    })
    </script>

    </html>
