<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <title>Document</title>
</head>
<body>

<div class="container-xxl flex-grow custom_css mt-3">
    <div class="col-lg-12 mb-12 order-0">
       <div class="card">
            <h4 class="card-header">Bot List
                <a class="widget widget-hover-effect header_nav">
                    <button type="button" class="btn btn-outline-primary btn-md" onclick="createViewFunction()"><i class="fa fa-plus"></i> Create Bot</button>
                </a>
                <a href="#" class="widget widget-hover-effect header_nav">
                    <button type="button" class="btn btn-outline-primary btn-md"><i class="fa fa-download"></i> Download Excel</button>
                </a>
                <a href="{{ route('products.home')}}" class="widget widget-hover-effect header_nav">
                    <button type="button" class="btn btn-outline-primary btn-md"><i class="fa fa-download"></i> HomePage</button>
                </a>

            </h4>
        
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="table_id" class="table">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Bot Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="cover-spin"></div>
</div>

<!-- Create Bot Modal -->
<div class="modal fade" id="BotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Bot</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="myDivBotype">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="mb-3 uppercase">
                                    <label for="">Bot Name</label>
                                    <input type="text" class="form-control" id="bot_name" name="bot_name" placeholder="Enter your bot name" autofocus value="" maxlength="50">
                                    {{-- <label for="">description</label>
                                    <textarea name="description" id="description" cols="5" rows="6" class="form-control" ></textarea> --}}
                                    <span id="bot_name_error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="createBot()" data-botname-url="{{ route('create_bot') }}" id="checkbotajax">Create</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="window.location.reload();">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Bot Modal -->
<div class="modal fade" id="EditBotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Bot</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="myDivBotype">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="mb-3 uppercase">
                                    <label for="">Bot Name</label>
                                    <input type="text" class="form-control" id="edit_bot_name" name="edit_bot_name" placeholder="Enter your bot name" autofocus value="" maxlength="50">
                                    <input type="hidden" name="editId" id="editId">
                                    <span id="edit_bot_name_error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="editBot()" data-botname-url="{{ route('edit_bot') }}" id="checkbotajax">Save Changes</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="window.location.reload();">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- status change modal --}}
<div class="modal fade" id="statusData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('update_bot_status') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="statusId" id="statusId">
                    <center>
                        <h6>Are you sure you want to change status?</h6>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sw">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sa" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- status change modal ajax method--}}
<div class="modal fade" id="statusData1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();"> 
                    {{-- we need onclick="window.location.reload();" when there is no form in modal --}}
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <input type="hidden" name="status" id="status">
                    <input type="hidden" name="statusId1" id="statusId1">
                    <center>
                        <h6>Are you sure you want to change status1?</h6>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sw" onclick="changeStatus()" >Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sa" data-dismiss="modal"  onclick="window.location.reload();">Close</button>
                </div>
        </div>
    </div>
</div>

{{-- delete bot modal --}}
<div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('delete_bot') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="deleteId" id="deleteId">
                    <center>
                        <h6>Are you sure you want to delete this record?</h6>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sw">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sa" data-dismiss="modal" onclick="window.location.reload();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- confirm duplicate bot modal --}}
<div class="modal fade" id="confirmBotDuplicate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Bot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <span style="font-size: 16px">Are you sure you want to clone this bot?</span>
                </center>
            </div>
            <div class="modal-footer">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary btn-sm" onclick="confirmBot()" data-botname-url="{{ route('create_bot') }}" id="checkBotAjax">Yes</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="window.location.reload();">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="BotDuplicateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Bot</h5>
            <div>
            <div class="modal-body">
                <div class="modal-body text-center" id="myDivBotype" style="height: 150px;">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="mb-3 uppercase">
                                    <input type="text" class="form-control" id="botduplicate_name" name="bot_name" placeholder="Enter your bot name" autofocus value ="" maxlength="50"/>
                                    <input type="hidden" name="botId" id="botId">
                                    <span id="botduplicate_name_error" style="color: red;"></span>
                                </div>
                                <!-- Buttons -->
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="duplicateBot()" data-botname-url="{{ route('create_bot') }}" id="checkBotAjax">Create</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="window.location.reload();">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
</div> --}}


{{-- duplicate bot modal --}}
<div class="modal fade" id="BotDuplicateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Bot</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body text-center" id="myDivBotype">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="mb-3 uppercase"></div>
                                <input type="text" class="form-control" id="botduplicate_name" name="bot_name" placeholder="Enter your bot name" autofocus value ="" maxlength="50"/>
                                <input type="hidden" name="botId" id="botId">
                                <span id="botduplicate_name_error" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="duplicateBot()" data-botname-url="{{ route('create_bot') }}" id="checkbotajax">Create</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="window.location.reload();">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="{{url('public/js/jquery-3.7.1.min.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajaxlist_bot') }}",
            columns: [
                { data: 'serial_number', name: 'serial_number', searchable: false },
                { data: 'bot_name', name: 'bot_name', searchable: false },
                { data: 'status', name: 'status', searchable: false },
                { data: 'action', name: 'action', searchable: false }
            ],
            lengthMenu: [ 
                [10, 25, 50, 100, -1], 
                [10, 25, 50, 100, "All"]
            ],
            pageLength: 10, 
            sPaginationType: "full_numbers", 
            order: [[0, "asc"]]
        });
    });

    function statusFunction(id) {
        $("#statusId").val(id);
        $("#statusData").modal('show');
    }

    function statusFunction1(id, status) {
        $("#statusId1").val(id);
        $("#status").val(status);
        $("#statusData1").modal('show');
    }

    function deleteFunction(id) {
        $("#deleteId").val(id);
        $("#deleteData").modal('show');
    }

    function duplicateFunction(id) {
        $("#botId").val(id);
        $("#confirmBotDuplicate").modal('show');
    }

    function confirmBot() {
        $("#BotDuplicateModal").modal('show');
        $("#confirmBotDuplicate").modal('hide');
    }

    function createViewFunction() {
        $("#BotModal").modal('show');
    }

    function createBot() {
        var bot_name = $("#bot_name").val();
        if (bot_name.length === 0) {
            $("#bot_name_error").text('Please enter a bot name');
            $('#bot_name_error').show();
            return false;
        } else {
            $('#bot_name_error').hide();
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // var postData = {
            //     bot_name: bot_name
            // };

            $.ajax({
                url: '{{ route("create_bot") }}',
                type: "POST",
                data: { bot_name, _token: "{{ csrf_token() }}"},
                success: function(response) {
                    if (response.available === 1) {
                        $("#bot_name_error").text('This bot name already exists');
                        $('#bot_name_error').show();
                    } else {
                        // event.PreventDefault();
                        window.location.reload();
                    }
                }
            });
        }
    }

    function EditViewFunction(id,name) {
        $("#edit_bot_name").val(name);
        $("#editId").val(id);
        $("#EditBotModal").modal('show');
    }

    function editBot() {
        var bot_name = $("#edit_bot_name").val();
        var id = $("#editId").val();

        if (bot_name.length === 0) {
            $("#edit_bot_name_error").text('Please enter a bot name');
            $('#edit_bot_name_error').show();
            return false;
        } else {
            $('#edit_bot_name_error').hide();
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // var postData = {
            //     bot_name: bot_name
            // };

            $.ajax({
                url: '{{ route("edit_bot") }}',
                type: "POST",
                data: { bot_name,id, _token: "{{ csrf_token() }}"},
                success: function(response) {
                    if (response.available === 1) {
                        $("#edit_bot_name_error").text('This bot name already exists');
                        $('#edit_bot_name_error').show();
                    } else {
                        // event.PreventDefault();
                        window.location.reload();
                    }
                }
            });
        }
    }

    function changeStatus() {
        var id = $("#statusId1").val();
        var status = $("#status").val();

        $.ajax({
            url: '{{ route("update_bot_status1") }}',
            type: "POST",
            data: { id, status, _token: "{{ csrf_token() }}"},
            success: function(response) {
                $("#statusData1").modal('hide');
                $('#table_id').DataTable().ajax.reload();
            }
        });
    }
</script>

<script>
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    });
</script>


</body>
</html>
