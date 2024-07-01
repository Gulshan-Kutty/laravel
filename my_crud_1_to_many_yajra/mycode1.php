<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" > --}}
   
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css"> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Hello, world!</title>
  </head>
  <body>
   
<!-- Button trigger modal -->

<div class="d-inline">
  <a class="btn btn-dark btn-sm mt-1" href="{{ route('popup.create') }}">Create</a>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- with from through --}}
      <div class="modal-body">
        <form action="{{route('popup.store')}}"  method="POST" enctype="multipart/form-data" >
          @csrf
      
         
            <div class="mb-3">
              <label for="exampleInputName1" class="form-label">Name</label>
              <input type="name" class="form-control" name="name" id="exampleInputname1" aria-describedby="nameHelp">
             
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp">
              
            </div>
            
            {{-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"  onclick="showModel()">
 <i class="fa fa-plus"></i> 
</button>




    {{-- model for body --}}

<!-- Button trigger modal -->












<!-- Modal for email -->
<div class="modal fade" id= "Viewemailbody"tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <span id="bodyID"></span>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    
<br> 
<br>
<div style="margin: auto; width: 50%;">
  <table class="table table-bordered data-table">
    <thead>
      <tr>
        <th>Name 
          <br> <input type="text" class="col-sm-5"  id="name_search"placeholder="Search for first namr..." data-column="0"/></th>

        <th>Email
         <br> <input type="text" class="col-sm-5"  id="email_search"placeholder="Search for first email..." data-column="1"/></th>
        <th>Action</th>
       
      </tr>
    </thead>

    <tbody>

    </tbody>
    <tfoot>
      <td>
        {{-- <select data-column="0" id="name_filter">
          <option value="">select name</option>
        </select> --}}


      </td>
    </tfoot>

    
  </table>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 


    {{-- <script>
    function ajaxForm(){
      $('#exampleModal1').modal(show);
    }
    </script> --}}
    <script>
    function showModel(){
      $('#exampleModal').modal(show);
    }
    </script>

    
    
    <script>

function ViewBodyFun(emailBody) {
        $("#bodyID").text(emailBody);
        
        $("#Viewemailbody").modal('show');
    }
    </script>

    <script type="text/javascript">
      $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('popup.index') }}",
            columns: [
                
                {data: 'name', name:'name'},
                {data: 'email', name:'email'},
                
                {data: 'action', name:'action', orderable: false, searchable: false},
            ]
        });
  



        $('#name_search').keyup(function(){
          table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#name_search').on('click', function(e) {
        e.stopPropagation(); // Stop event from bubbling up
        });

         $('#email_search').keyup(function(){
          table.column($(this).data('column')).search($(this).val()).draw();
        });


        $('#email_search').on('click', function(e) {
        e.stopPropagation(); // Stop event from bubbling up
        });
        // $('#name_filter').change(function(){
        //   table.column($(this).data('column')).search($(this).val()).draw();
        // });

       
      });

      
    </script>
   

    
      



    
    
    
    
    
    
    
    
  
  </body>
</html>