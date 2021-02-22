@include('dashboard/layouts/header')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('dashboard/layouts/aside')



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('dashboard/layouts/nav')

        <!-- Begin Page Content -->
        <div class="container-fluid">

       <div class="w3-container w3-margin-top brnda-card-4">


           <!-- begin agars images -->
           <div class="w3-animate-zoom w3-margin-bottom w3-responsive">
              <div id="agar_info_bar" class="w3-bar w3-white w3-border-bottom w3-padding">
                  <div class="wrapper w3-row">
                      <a href="#agar_desc" class="w3-bar-item w3-button w3-large w3-hover-none w3-hover-text-gray" style="width:25%">الوصف</a>
                      <a href="#agar_loc" class="w3-bar-item w3-button w3-large w3-hover-none w3-hover-text-gray" style="width:25%">الموقع</a>
                      <a href="#agar_feature" class="w3-bar-item w3-button w3-large w3-hover-none w3-hover-text-gray" style="width:25%">المميزات</a>
                      <a href="#agar_policy" class="w3-bar-item w3-button w3-large w3-hover-none w3-hover-text-gray" style="width:25%">الشروط</a>
                  </div>
              </div>
                <!-- !PAGE CONTENT! -->
            <div class="w3-main" style=""><!-- START view agar -->
              <!-- Container for the image gallery -->
              @if($agar->image->count())
                <div class="">
                    <!-- slider -->
                    <div class="w3-margin-top w3-display-container">
                      @foreach($agar->image as $image)
                        <div class="w3-display-container w3-tooltip">
                            <img width="100%" class="mySlides" src="{{ asset('agar/images/'.$image->img_wide) }}" alt="{{$image->img_wide}}">
                        </div>
                      @endforeach
                      <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                      <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                    </div>
                </div>
              @endif

              <br>

              <div class="wrapper">
                <div class="w3-row-padding">
                  <section class="w3-right">
                      <section class="w3-section">
                          <h2 class="text-right">
                            {{ $agar->agar_name }}
                          </h2>

                          <h6 class="text-right w3-margin-top">
                              موقع العقار
                              <i class="fa fa-map-marker-alt w3-margin-left-8"></i>
                              <span>
                                <a class="decoration-none hover-underline" href="#">{{ $agar->location->state->state_name }} /</a>
                                <a class="decoration-none hover-underline" href="#">{{ $agar->location->city->city_name }} /</a>
                                <a class="decoration-none hover-underline" href="#">{{ $agar->location->area }}</a>
                              </span>
                          </h6>
                      </section>
                      <section style="margin-bottom: 32px !important;">
                          <div class="w3-bar">
                              <span class="w3-bar-item  w3-text-gray">
                                  <i class="fa fa-bed w3-margin-left-8"></i>
                                  <span>{{ $agar->rooms_number }} غرف نوم</span>
                              </span>
                              <span class="w3-bar-item w3-margin-left-8 w3-text-gray">
                                  <i class="fa fa-bath w3-margin-left-8"></i>
                                  <span>{{ $agar->bathrooms_number }} دورات مياه</span>
                              </span>
                              <span class="w3-bar-item w3-margin-left-8 w3-text-gray">
                                  <i class="fa fa-building w3-margin-left-8"></i>
                                  <span>{{ $agar->floor->floor_name }}<span>
                              </span>
                          </div>
                          <div id="agar_desc"></div>
                      </section>
                      <section class="w3-section" style="margin-bottom: 32px !important;">
                          <h3 class="text-right">الوصف</h3>
                          <p class="more text-right">{{ $agar->agar_desc }}</p>
                          <div id="agar_loc"></div>
                      </section>
                      <section class="w3-section" style="margin-bottom: 64px !important;" >
                          <h3>الموقع على الخريطة</h3>
                          <div id="map" style="width: 500px;height: 400px"></div>
                          <script>
                            function initMap() {
                              var uluru = {lat: <?php echo $agar->location->lat ?>, lng: <?php echo $agar->location->lng ?>};
                              var map = new google.maps.Map(
                                  document.getElementById('map'), {zoom: 4, center: uluru});
                              var marker = new google.maps.Marker({position: uluru, map: map});
                            }
                          </script>
                          <script async defer
                          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7Yl8XjIAZ28pE5uNuZ0GdR_q_125UxY&callback=initMap">
                          </script>


                          <div id="agar_feature"></div>
                      </section>
                      <section class="w3-section text-right">
                          <h3>المميزات</h3>
                          <hr/>
                          <h4>المرافق الأساسية</h4>
                          <section class="w3-section">
                            <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-dark-gray">
                                <?php if($agar->agar_extra->b_extra != null): ?>
                                  <?php $b_extra = json_decode($agar->agar_extra->b_extra); foreach ($b_extra as $b_extra):?>
                                    <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-flat-peter-river">
                                        <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $b_extra; ?> </span>
                                  <?php endforeach ; ?>
                                <?php else: ?>
                                  <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
                                      <h3 class="">فارغ! لا توجد بيانات هنا.</h3>
                                  </div>
                                <?php endif ; ?>
                            </span>
                          </section>
                          <hr/>
                          <h4>المرافق الإضافية</h4>
                          <section class="w3-section">
                            <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-black-gray">
                              <?php if($agar->agar_extra->a_extra != null): ?>
                                <?php $a_extra = json_decode($agar->agar_extra->a_extra); foreach ($a_extra as $a_extra):?>
                                  <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-flat-peter-river">
                                      <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $a_extra; ?> </span>
                                <?php endforeach ; ?>
                              <?php else: ?>
                                <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
                                    <h3 class="">فارغ! لا توجد بيانات هنا.</h3>
                                </div>
                              <?php endif ; ?>
                            </span>
                          </section>
                          <hr/>
                          <h4>الميزات الخاصة</h4>
                          <section class="w3-section">
                              <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-black-gray">
                                  <?php if($agar->agar_extra->sf_extra != null): ?>
                                    <?php $sf_extra = json_decode($agar->agar_extra->sf_extra); foreach ($sf_extra as $sf_extra):?>
                                      <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-flat-peter-river">
                                          <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $sf_extra; ?> </span>
                                    <?php endforeach ; ?>
                                  <?php else: ?>
                                    <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
                                        <h3 class="">فارغ! لا توجد بيانات هنا.</h3>
                                    </div>
                                  <?php endif ; ?>
                              </span>
                              <div id="agar_policy"></div>
                          </section>
                          <h3>شروط السكن</h3>
                          <hr/>
                          <section class="w3-section">
                            <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-black-gray">
                                <?php if($agar->agar_extra->cond_extra != null): ?>
                                  <?php $cond_extra = json_decode($agar->agar_extra->cond_extra); foreach ($cond_extra as $cond_extra):?>
                                    <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-flat-peter-river">
                                        <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $cond_extra; ?> </span>
                                  <?php endforeach ; ?>
                                <?php else: ?>
                                  <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
                                      <h3 class="">فارغ! لا توجد بيانات هنا.</h3>
                                  </div>
                                <?php endif ; ?>
                              </span>
                          </section>
                      </section>
                  </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
  @include('dashboard/layouts/footer')

  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }
  </script>

<!-- Bootstrap core JavaScript-->
<script src="{{  asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('dashboard/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
