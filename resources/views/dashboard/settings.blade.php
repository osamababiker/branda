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

          <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4"> اعدادات الموقع </h1>
                      </div>
                      <form class="user" method="post" action="{{ route('dashboard.settings') }}">
                        @csrf
                        <div class="form-group text-right">
                          <label>اسم الموقع</label>
                          <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control text-right" >
                        </div>
                        <div class="form-group row text-right">
                          <div class="col-md-6">
                            <label for="email_two"> الايميل الثاني  </label>
                            <input id="email_two" type="text" value="{{ $settings->email_two }}"  class="form-control text-right" name="email_two">
                          </div>
                          <div class="col-md-6">
                            <label for="email_one"> الايميل الاول  </label>
                            <input id="email_one" type="text" value="{{ $settings->email_one }}"  class="form-control text-right" name="email_one">
                          </div>
                        </div>
                        <div class="form-group text-right">
                          <label for="region">المقر</label>
                          <input id="region" type="text" value="{{ $settings->address }}"  name="address" class="form-control text-right" >
                        </div>
                        <div class="form-group text-right">
                          <label for="logo">شعار الموقع</label>
                          <input id="logo" type="file" name="logo" value="{{ $settings->logo }}"  class="form-control text-right" >
                        </div>
                        <div class="form-group row text-right">
                          <div class="col-md-6">
                            <label for="phone_two"> الرقم الثاني   </label>
                            <input id="phone_two" type="text" class="form-control text-right" value="{{ $settings->phone_two }}" name="phone_two">
                          </div>
                          <div class="col-md-6">
                            <label for="phone_one"> الرقم الاول   </label>
                            <input id="phone_one" type="text" class="form-control text-right" value="{{ $settings->phone_one }}"  name="phone_one">
                          </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $settings->id }}" >
                        <button type="submit" class="btn btn-primary w3-right">
                          تحديث
                        </button>
                      </form>
                      <div class="w3-clear"></div>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


      @include('dashboard/layouts/footer')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('dashboard/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dashboard/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('dashboard/js/demo/chart-pie-demo.js') }}"></script>

  </body>

  </html>
