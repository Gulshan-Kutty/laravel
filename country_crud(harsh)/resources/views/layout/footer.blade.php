@yield('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){ 
     $(".alert").fadeTo(1000, 500).slideUp(500, function(){
         $(".alert").slideUp(600);
         setTimeout(window.location.href = "{{route('country.index')}}", 1000);
       });
      
  })
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script>
</body>
</html>