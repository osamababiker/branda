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

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-right"> ادارة استفسارات المستخدمين</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-right">
                 جدول الاستفسارات
                 <a class="w3-text-red w3-left w3-button w3-card w3-white" href="{{ route('dashboard.contact') }}" >
                   <i class="fa fa-plus w3-large"></i>
                 </a>
               </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-right">
                      <th> اسم المستخدم </th>
                      <th> رقم الهاتف </th>
                      <th> الغرض من الرسالة  </th>
                      <th> نص الرسالة </th>
                      <th>  حالة الاستفسار </th>
                      <th>العمليات</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="text-right">
                      <th> اسم المستخدم </th>
                      <th> رقم الهاتف </th>
                      <th> الغرض من الرسالة  </th>
                      <th> نص الرسالة </th>
                      <th>  حالة الاستفسار </th>
                      <th>العمليات</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($messages as $message)
                      <tr class="text-right">
                        <td>{{ $message->username }}</td>
                        <td> {{ $message->phone }} </td>
                        <td> {{ $message->subject }} </td>
                        <td>
                          <button type="button" class="w3-button w3-card w3-white" onclick="document.getElementById('message_{{ $message->id }}').style.display = 'block'" name="button">
                            <i class="fa fa-ellipsis-h"></i>
                          </button>
                        </td>
                        <!-- message body -->
                        <div class="w3-modal" id="message_{{ $message->id }}">
                          <div class="w3-modal-content w3-card-4 w3-padding-64 w3-animate-zoom" style="max-width:480px">
                            <span onclick="document.getElementById('message_{{ $message->id }}').style.display='none'"
                            class="w3-button w3-large w3-display-topright">&times;</span>
                            <div class="w3-margin">
                              <p> {{ $message->message }} </p>
                            </div>
                          </div>
                        </div>
                        <td>
                          @if($message->is_closed == 1)
                            <i class="fa fa-check w3-text-green"> تم الرد </i>
                          @else
                            <i class="fa fa-times w3-text-red"> لم يتم الرد </i>
                          @endif
                        </td>
                        <td style="width: 50px">
                          <form action="{{ route('dashboard.contact') }}" method="post">
                            @csrf
                            <input type="hidden" name="message_id" value="{{ $message->id }}" />
                            <button type="submit" name="delete_btn" class="btn btn-danger"  >
                               <i class="fa fa-times-circle"></i>
                             </button>
                             @if($message->is_closed == 0)
                             <button type="submit" name="close_btn" class="btn btn-success w3-margin-top"  >
                                <i class="fa fa-check"></i>
                              </button>
                              @endif
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('dashboard/layouts/footer')

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
