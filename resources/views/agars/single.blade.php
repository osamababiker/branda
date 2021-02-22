<!DOCTYPE html>
<html>
<head>
    <title>  برندة    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet"  href="{{ asset('lib/lightslider-master/src/css/lightslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-windows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">
    <link rel="stylesheet"
          href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">


    <!-- for vue js app.js file -->
   <script src="{{ asset('js/app.js') }}" defer></script>

</head>


  <body  class="text-right">
    <div class="w3-white">


    <!-- sidebar menu -->
      @include('layouts/aside')

      <!-- Overlay effect when opening sidebar on small screens -->
      <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="wrapper" dir="rtl"><!-- START view agar -->
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
                <div class="container">
                    <!-- slider -->
                    <div class="w3-content w3-display-container">
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
                  <section class="w3-twothird">
                      <section class="w3-section">
                          <h2>{{ $agar->agar_name }}</h2>
                          <h6>
                              <i class="fa fa-map-marker w3-margin-left-8"></i>
                              <span>
                                <span>{{ $agar->location->state->state_name }} /</span>
                                <span>{{ $agar->location->city->city_name }} /</span>
                                <span>{{ $agar->location->area }}</span>
                              </span>
                          </h6>
                      </section>
                      <section class="w3-section" style="margin-bottom: 64px !important;">
                          <div class="w3-bar">
                              <span class="w3-bar-item w3-margin-left-8 w3-text-gray">
                                  <i class="fa fa-money w3-margin-left-8"></i>
                                  <span>
                                    {{ $agar->price->day }}
                                    @if($agar->price->currency == 1)
                                      حنيه
                                    @else
                                      دولار
                                    @endif
                                  </span>
                              </span>
                              <span class="w3-bar-item w3-margin-left-8 w3-text-gray">
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
                      </section>
                      <section class="w3-section" style="margin-bottom: 64px !important;">
                          <h3>الوصف</h3>
                          <span class="more" id="agar_desc">{{ $agar->agar_desc }}</span>
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
                      <section class="w3-section">
                          <h3>المميزات</h3>
                          <hr/>
                          <h4>المرافق الأساسية</h4>
                          <section>
                            <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-text-dark-gray">
                                <?php if($agar->agar_extra->b_extra != null): ?>
                                  <?php $b_extra = json_decode($agar->agar_extra->b_extra); foreach ($b_extra as $b_extra):?>
                                    <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-color-brnda">
                                        <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $b_extra; ?> </span>
                                  <?php endforeach ; ?>
                                <?php else: ?>
                                  <div class="w3-panel w3-brnda" style="padding-top: 10px;">
                                      <p class=""> لم يتم اضافة المرافق الاساسية </p>
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
                                  <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-color-brnda">
                                      <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $a_extra; ?> </span>
                                <?php endforeach ; ?>
                              <?php else: ?>
                                <div class="w3-panel w3-brnda" style="padding-top: 10px;">
                                    <p class=""> لم يتم اضافة المرافق الاضافية </p>
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
                                      <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-color-brnda">
                                          <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $sf_extra; ?> </span>
                                    <?php endforeach ; ?>
                                  <?php else: ?>
                                    <div class="w3-panel w3-brnda" style="padding-top: 10px;">
                                        <p class=""> لم يتم اضافة المميزات الخاصة </p>
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
                                    <span class="w3-show-inline-block w3-padding w3-margin-left-8 w3-color-brnda">
                                        <i class="fa fa-check-circle w3-margin-left-8"></i> <?php echo $cond_extra; ?> </span>
                                  <?php endforeach ; ?>
                                <?php else: ?>
                                  <div class="w3-panel w3-brnda" style="padding-top: 10px;">
                                      <p class=""> لم يتم اضافة شروط السكن </p>
                                  </div>
                                <?php endif ; ?>
                              </span>
                          </section>
                      </section>
                  </section>
                  <section class="w3-third">
                    @if(Auth::check())
                      @if($agar->owner_id != Auth::user()->id)
                        <div class="w3-card w3-animate-zoom w3-flat-clouds"><!-- START CALENDAR_FORM -->
                            <div class="w3-container">
                                <input type="hidden" name="agar_id" value="{{ $agar->id }}">
                                <input type="hidden" name="calendar_id" value="{{ $agar->calender }}">
                                <div class="" id="reservation">
                                    <reservation-app :owner_id="{{ $agar->owner_id }}" :agar_id="{{ $agar->id }}"></reservation-app>
                                </div>
                            </div>
                        </div><!-- END CALENDAR_FORM -->

                        <!-- reservation success message -->
                        <div class="w3-modal" id="reservation_success" style="display: none">
                          <div class="w3-panel w3-modal-content w3-card-4 w3-padding-64 w3-animate-zoom" style="max-width:480px">
                            <span onclick="document.getElementById('reservation_success').style.display='none'"
                            class="w3-button w3-large w3-display-topright">&times;</span>
                            <h3 class="w3-center"> تم ارسال طلب الايجار بنجاح </h3>
                          </div>
                        </div>

                        <!-- reservation error message -->
                        <div class="w3-modal" id="reservation_error" style="display: none">
                          <div class="w3-panel w3-modal-content w3-card-4 w3-padding-64 w3-animate-zoom" style="max-width:480px">
                            <span onclick="document.getElementById('reservation_error').style.display='none'"
                            class="w3-button w3-large w3-display-topright">&times;</span>
                            <h3 class="w3-center"> حصل خطأ ما اثناء ارسال  الطلب الرجاء التحقق من صحة البيانات </h3>
                          </div>
                        </div>
                      @endif
                    @else
                      <section class="w3-panel w3-brnda w3-center" style="padding-top: 10px;">
                        <p> قم بتسجيل دخولك لتتمكن من ارسال طلب ايجار </p>
                        <a href="/lets" class="w3-button w3-white w3-card w3-margin-bottom"> تسجيل دخول </a>
                      </section>
                    @endif
                  </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    @include('layouts/footer')

    <script src="{{ asset('js/script.js') }}"></script>

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

</body>
</html>
