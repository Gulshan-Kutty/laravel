<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('resources/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
    <div class="container"><br>
        
        
        <label for="from">From</label>
        <input type="text" id="from" name="from">
        <label for="to">to</label>
        <input type="text" id="to" name="to">
        <br><br>
        Date:<input type="text" id="datepicker">
        <h5>Basic DateTime</h5>
        <input type="text" id="basicDate" placeholder="Please select Date Time" data-input>
    
        <h5>Range Datetime</h5>
        <input type="text" id="rangeDate" placeholder="Please select Date Range" data-input>
    
        <h5>Time Picker</h5>
        <input type="text" id="timePicker" placeholder="Please select Time">
        <h3>Ck editor</h3>
        <div id="editor"><p>Hello Ck editor</p></div>
        <br><br><br> 
        <h3>Summernote</h3>
        <div id="summernote"><p>Hello Summernote</p></div>

        <a href="{{route('country.index')}}" class="btn btn-success">Home</a>
      </div><br>
      
    </div>



{{-- jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


{{-- datepicker --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
 
     $("#datepicker").datepicker({
       changeMonth:true,
       changeYear:true,
       showButtonPanel:true,
       controls: ['calendar'],
        selectMultiple: true,
     })
   
 </script>
 

 {{-- flatpicker --}}

 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 <script>
   $("#basicDate").flatpickr({
     enableTime: true,
     dateFormat: "F, d Y H:i"
 });
 
 $("#rangeDate").flatpickr({
     mode: 'range',
     dateFormat: "Y-m-d"
 });
 
 $("#timePicker").flatpickr({
     enableTime: true,
     noCalendar: true,
     time_24hr: true,
     dateFormat: "H:i",
 });
 </script>



{{-- ckeditor --}}

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
          console.error( error );
      } );
</script>


{{-- Summernote --}}

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
      $('#summernote').summernote();
  });
</script>



{{-- for range in datepicker --}}

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
</body>
</html>