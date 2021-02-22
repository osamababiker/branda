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
                <div class="row" dir="rtl">
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4 w3-right"> اضافة عنوان بنكي جديد  </h1>
                        <a class="w3-text-red w3-left w3-button w3-card w3-white"  href="{{ route('dashboard.paymentAddressTable') }}" >
                          <i class="fa fa-plus w3-large"></i>
                        </a>
                      </div>

                      <div class="w3-clear"></div>

                      <form class="user" method="post" action="{{ route('dashboard.paymentAddress') }}">
                        @csrf
                        <div class="row">
                          <div class="form-group col-md-6 text-right">
                            <label>اسم البنك</label>
                            <input type="text" name="name" class="form-control text-right" >
                          </div>
                          <div class="form-group col-md-6 text-right">
                            <label> الفرع</label>
                            <input type="text" name="branch" class="form-control text-right" >
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 text-right">
                            <label> العنوان </label>
                            <input type="text" name="address" class="form-control text-right" >
                          </div>
                          <div class="form-group col-md-6 text-right">
                            <label> رقم الحساب </label>
                            <input type="number" name="account_number" class="form-control text-right" >
                          </div>
                        </div>
                        <button type="submit" name="add_btn" class="btn btn-primary w3-right">
                          اضافة
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
