<!DOCTYPE html>
<html>
<head>
  <title>برندا</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="loading_icon" content="{{ asset('images/icons/load.gif') }}">
  <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css')}}"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('js/ion.rangeSlider.js') }}"></script>

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/webfonts/FontAwesome.otf') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('datepicker/css/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/agarsList.css') }}">
  <link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">

   <!-- for vue js app.js file -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- genral css file -->
  <link rel="stylesheet" href="{{ asset('css/general.css') }}">
</head>

<body dir="" class="text-right">
  <div class="w3-white">


  <!-- sidebar menu -->
    @include('layouts/aside')

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <section class="container">
      <section class="filter-body" id="filter">
        <filter-app
              :agar-type="{{ $agarType }}"
              :agar-floor="{{ $agarFloor }}"
              :agar_b_extra="{{ $agar_b_extra }}"
              :agar_a_extra="{{ $agar_a_extra }}"
              :agar_s_extra="{{ $agar_s_extra }}"
              :agar_cond="{{ $agar_cond }}"
              :agar_location="{{ $agar_location }}">
        </filter-app>

      </section>
    </section>


  @include('layouts/footer')


    <script>
      $(document).ready(function(){
       height = $('#filter').height();
       height = $('.filter_web_sidebar').height(height);
       console.log(height)
      });
    </script>


    <script>
      function open_filter() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("filter_sidebar").style.width = "25%";
        document.getElementById("filter_sidebar").style.display = "block";
      //  document.getElementById("openNav").style.display = 'none';
      }
      function close_filter() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("filter_sidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }
    </script>

    <script type="text/javascript">
        $("#price_range").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 200,
          to: 500,
          grid: true
        });

        $("#price_mobile_range").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 200,
          to: 500,
          grid: true
        });
    </script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(agar_slide,n) {
      console.log(agar_slide);
      showDivs(agar_slide,slideIndex += n);
    }

    function showDivs(agar_slide,n) {
      var i;
      var x = document.getElementsByClassName(agar_slide);
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }
  </script>
  <!-- this for mobile screen only -->
  <script>
    var slideIndex = 1;
    showMobileDivs(slideIndex);

    function plusMobileDivs(n) {
      showMobileDivs(slideIndex += n);
    }

    function showMobileDivs(n) {
      var i;
      var x = document.getElementsByClassName("mobile-Slides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }
  </script>

  <script>
  // Tabs
  function openLink(evt, linkName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("myLink");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(linkName).style.display = "block";
    evt.currentTarget.className += " w3-red";
  }

  // Click on the first tablink on load
  document.getElementsByClassName("tablink")[0].click();
  </script>

  <script src="{{ asset('js/script.js') }}"></script>

  <!-- date picker -->
  <script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}" ></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({
        multidate: true
      });
    } );
  </script>

  <script>
    $( function() {
      $( "#datepicker_mobile" ).datepicker({
        multidate: true
      });
    } );
  </script>


  </div>
</body>
</html>
