<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap downloaded file linked here--}}
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    {{-- toastr --}}
    {{-- <link rel="stylesheet" href="{{url('public/css/bootstrap-toastr.min.css')}}" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    {{-- select2 --}}
    <link rel="stylesheet" href="{{url('public/css/select2.min.css')}}">
    {{-- Multiselect-dropdown--}}
    <link rel="stylesheet" href="{{url('public/css/multi-select-tag.css')}}">
    {{-- datepicker --}}
    <link rel="stylesheet" href="{{url('public/css/datepicker.min.css')}}">
    {{-- flatpicker --}}
      <link rel="stylesheet" href="{{url('public/css/flatpickr.min.css')}}">
    {{-- timepicker --}}
    <link rel="stylesheet" href="{{url('public/css/jquery.timepicker.min.css')}}">
    {{-- summernote --}}
    <link rel="stylesheet" href="{{url('public/css/summernote-bs4.min.css')}}">
    

    <title>Title</title>

</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mt-3 p-3">
                    <h4>Select Country(select2)</h4><br>
                    <select class="dropdown col-sm-2 " style="width:450px" name="select" id='select' multiple>
                        <option value="IN">India</option>
                        <option value="PA">Pakistan</option>
                        <option value="TH">Thailand</option>
                    </select><br><br>
                <h4>Select Country(Multi-select)</h4>
                <select class="dropdown col-sm-2 " style="width:200px" name="multi[]" id='multi' multiple>
                    <option value="IN">India</option>
                    <option value="PA">Pakistan</option>
                    <option value="CH">China</option>
                    <option value="RU">Russia</option>
                    <option value="BA">Bangladesh</option>
                    <option value="BH">Bhutan</option>
                    <option value="TH">Thailand</option>
                </select><br><br>

                <h4>Datepicker:</h4><input type="text" id="datepicker"><br>
                <h4>Flatpicker:</h4><input type="text" id="flatpicker"><br>
                <h4>Timepicker:</h4><input type="text" id="timepicker"><br>
                <div class="form-group">
                    <h4>Description:</h4>
                    <textarea class="ckeditor form-control" name="description"></textarea>
                </div>
            </div>
        </div>
        </div>
    </div>

</body>

{{-- jquery downloaded file linked here--}}
<script src="{{'public/js/jquery-3.7.1.min.js'}}"></script>
{{-- select2 --}}
<script src="{{'public/js/select2.min.js'}}"></script>
{{-- Multiselect-dropdown--}}
<script src="{{'public/js/multi-select-tag.js'}}"></script>
{{-- datepicker --}}
<script src="{{'public/js/datepicker.min.js'}}"></script>
{{-- flatpicker --}}
<script src="{{'public/js/flatpickr.min.js'}}"></script>
{{-- timepicker --}}
<script src="{{'public/js/jquery.timepicker.min.js'}}"></script>
{{-- ckeditor --}}
{{-- <script src="{{'public/js/ckeditor.js'}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.24.0/ckeditor.js" integrity="sha512-Vzo9BnO8qlWYp96AZsG6QtNm+csiTPp3mBn5KtAOUBdj9cqfjRTN7e418F92/pVx9SOOsYwNPV+vhsf+lU5lxg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


{{-- summernote --}}
<script src="{{'public/js/summernote.min.js'}}"></script>



<script>
    $(document).ready(function(){
      // $(".dropdown").select2();

      $("#select").select2();

      new MultiSelectTag('multi')

      $("#datepicker").datepicker();

      $("#flatpicker").flatpickr();

      $("#timepicker").timepicker();

      $(".ckeditor").ckeditor();

    });


</script>

</html>