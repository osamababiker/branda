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

          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800 text-right"> ادارة عمليات الدفع</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">
                   جدول عمليات الدفع
                   <a class="w3-text-red w3-left w3-button w3-card w3-white" href="{{ route('dashboard.add_cities') }}" >
                     <i class="fa fa-plus w3-large"></i>
                   </a>
                 </h6>
              </div>

              @foreach($reservations as $reservation)
                <div class="card shadow" dir="rtl">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr class="text-right">
                            <th> اسم العقار   </th>
                            <th> مقدم طلب الاستئجار </th>
                            <th> صورة للفاتورة </th>
                            <th>العمليات</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr class="text-right">
                            <th> اسم العقار   </th>
                            <th> مقدم طلب الاستئجار </th>
                            <th> صورة للفاتورة </th>
                            <th>العمليات</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <tr class="text-right">
                            <td>{{ $reservation->agar->agar_name }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            @if($reservation->bill)
                              <td>
                                <a target="_blank" href="/bill/images/{{$reservation->bill->bill_image}}">
                                  <img src="{{ asset('bill/images/'.$reservation->bill->bill_image) }}" width="100" height="100"></td>
                                </a>
                            @else
                              <td></td>
                            @endif
                            <td>
                              <form class="user" id="payment_{{ $reservation->id }}" method="post" action="{{ route('dashboard.payment') }}">
                                @csrf
                                <input type="hidden" value="{{ $reservation->id }}" name="reservation_id" />
                                <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
                                <input type="hidden" name="reciver_id" value="{{ $reservation->reciver_id }}">
                                <div class="form-group text-right">
                                  <div class="">
                                    <label for="confirm"> تم الدفع </label>
                                    <input id="confirm" type="radio" class="form-control-user" name="action" value="confirm">
                                  </div>
                                  <div class="">
                                    <label for="delete"> حذف الطلب  </label>
                                    <input id="delete" type="radio" class="form-control-user" name="action" value="delete">
                                  </div>
                                </div>
                                <button type="submit" form="payment_{{ $reservation->id }}" class="btn btn-primary w3-right">
                                  اتمام
                                </button>
                              </form>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                 </div>
                <div class="w3-clear"></div><hr>
                @endforeach
              </div>
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
