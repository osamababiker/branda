@include('layouts/header')

<!-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> -->

<body  class="text-right">
  <div class="w3-white">


  <!-- sidebar menu -->
    @include('layouts/aside')

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- -->

  <br>
  <div class="w3-content  w3-card w3-responsive" dir="rtl">

  <div class="w3-container">
    <h2> طلبات الايجار المرسلة </h2>
  </div>

  <div class="w3-bar w3-border-bottom w3-card">
    <button style="cursor: pointer"  class="w3-bar-item w3-hover-border-bottom-brnda  tablink" onclick="openTab(event,'all')"><i class="fa fa-plus-square"></i> كل الطلبات </button>
    <button style="cursor: pointer"  class="w3-bar-item w3-hover-border-bottom-brnda tablink" onclick="openTab(event,'accepted')"><i class="fa fa-check-square"></i> الطلبات المقبولة</button>
    <button style="cursor: pointer" class="w3-bar-item w3-hover-border-bottom-brnda tablink" onclick="openTab(event,'confirmable')"><i class="fa fa-check-square"></i> الطلبات المؤكدة</button>
    <button style="cursor: pointer" class="w3-bar-item w3-hover-border-bottom-brnda tablink" onclick="openTab(event,'rejected')"><i class="fa fa-check-square"></i> الطلبات المرفوضة</button>
  </div>

  <div id="all" class="w3-container tabs">
   <div class="w3-margin-bottom w3-margin-top">
        <div id="id62" class="w3-modal">
            <div class="w3-modal-content">

            </div>
          </div>
          <div class="w3-responsive"> <!-- START table data -->
              <table class="w3-table w3-striped w3-margin-bottom">
                  <thead>
                  <tr class="">
                      <th class="">اسم العقار</th>
                      <th class="">بداية الإيجار</th>
                      <th class="">نهاية الإيجار</th>
                      <th class="	"> تاريخ الطلب</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                            <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                            <td>{{ $start_date->format('Y-m-d')  }}</td>
                            <td>{{ $end_date->format('Y-m-d') }}</td>
                            <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                        </tr>
                      @endforeach
                  </tbody>
              </table>
          </div><!-- END table data -->
      </div><!-- END list -->
  </div>

  <!-- accepted reservation only -->
  <div id="accepted" class="w3-container tabs">
     <div class="w3-margin-bottom w3-margin-top">
       <div class="w3-responsive"> <!-- START table data -->
         <table class="w3-table w3-striped w3-margin-bottom">
            <thead>
              <tr class="">
                  <th class="">اسم العقار</th>
                  <th class="">بداية الإيجار</th>
                  <th class="">نهاية الإيجار</th>
                  <th class="	"> تاريخ الطلب</th>
                  <th class="">اتمام عملية الدفع</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($accepted_reservations as $reservation)
                    <tr>
                        <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                        <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                        <td>{{ $start_date->format('Y-m-d')  }}</td>
                        <td>{{ $end_date->format('Y-m-d') }}</td>
                        <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                        @if($reservation->bill)
                          <td>
                            <a href="#">
                                <img  onclick="document.getElementById('bill_image_{{ $reservation->bill->id }}').style.display='block'" class="w3-hover-grayscale" src="{{ asset('bill/images/'.$reservation->bill->bill_image) }}" height="100" width="100">
                            </a>
                          </td>
                        @else
                          <td>
                            <div class="">
                                <div class="w3-bar">
                                    <button onclick="document.getElementById('pay_{{ $reservation->id }}').style.display='block'" class=" w3-btn w3-mobile w3-text-gray w3-border col-md-12" style="padding: 0;"><i class="fa fa-credit-card" style="padding: 5px;"></i></button>
                                </div>
                            </div>
                          </td>
                        @endif
                      </tr>

                      @if($reservation->bill)
                      <!-- START delete bill image MODAL -->
                      <div id="bill_image_{{ $reservation->bill->id }}" class="w3-modal">
                        <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                            <header class="w3-container brnda-card">
                                <span onclick="document.getElementById('bill_image_{{ $reservation->bill->id }}').style.display='none'"
                                  class="w3-btn w3-display-topleft">&times;</span>
                                <h4>حذف</h4>
                            </header>
                            <form action="{{ route('reservation.sent') }}" method="post" id="bill_image_form_{{ $reservation->bill->id }}">
                                @csrf
                                <input type="hidden" name="reserv_id" value="{{ $reservation->id }}">
                                <div class="w3-container">
                                    <div class="w3-section">
                                        <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue w3-text-gray"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                                    </div>
                                </div>

                                <footer class="w3-container ">
                                    <div class="w3-margin-top w3-margin-bottom w3-left">
                                        <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                            <button form="bill_image_form_{{ $reservation->bill->id }}" name="delete_bill_btn" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                            <button type="button" onclick="document.getElementById('bill_image_{{ $reservation->bill->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                        </div>
                                  </footer>
                                </form>
                            </div>
                        </div>
                        <!-- END delete bill image MODAL -->
                        @endif

                      <!-- START pay for reservation  MODAL -->
                      <div id="pay_{{ $reservation->id }}" class="w3-modal">
                        <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                            <header class="w3-container brnda-card">
                              <span onclick="document.getElementById('pay_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-display-topleft">&times;</span>
                              <h4>  كيف تود اتمام عملية الدفع </h4>
                              <ol>
                                <li><a href="#" class="paymentLink" onclick="paymentTab(event,'cash')" > دفع مباشر </a></li>
                                <li><a href="#" class="paymentLink" onclick="paymentTab(event,'bank')" > تحويل بنكي </a></li>
                              </ol>
                            </header>
                            <div class="payment_tabs" id='cash' style="display: none">
                              <div class="w3-margin w3-card w3-padding w3-light-grey">
                                <h4>شكرا جزيلا لاختيارك التعامل مع برندا</h4>
                                  <p>
                                    لاتمام عملية الدفع يمكنك التفضل بزيارة مكتبنا في
                                     <address class="">{{ $settings->address }}</address>
                                  </p>
                                    او الاتصال علينا في الارقام التالية
                                    <ol>
                                      <li>{{ $settings ->phone_one }}</li>
                                      <li>{{ $settings ->phone_two }}</li>
                                    </ol>
                                </p>
                            </div><br>
                            </div>
                            <div class="payment_tabs" id='bank' style="display: none">
                              <form action="{{ route('reservation.sent') }}" method="post" id="pay_form_{{ $reservation->id }}" enctype="multipart/form-data">
                                @csrf
                                <footer class="w3-margin w3-padding w3-light-grey text-right w3-container">
                                  <div class="">
                                    @foreach($paymentAddress as $address)
                                      <p>
                                        {{ $address->name }}, {{ $address->branch }}, {{ $address->address }}
                                        <span> حساب رقم {{ $address->account_number }} </span>
                                      </p>
                                    @endforeach
                                  </div>
                                  <div class="w3-margin-top w3-margin-bottom">
                                    <input type="hidden" value="{{ $reservation->id }}" name="reservation_id" /><hr>
                                    <label for="bill_file" class="w3-large">صورة لفاتورة الدفع</label><br>
                                    <input type="file" name="bill_file" id="bill_file"><br><hr>
                                  </div>
                                </footer>
                                <div class="w3-container">
                                  <button form="pay_form_{{ $reservation->id }}" name="pay_btn" value="دفع"class="w3-btn w3-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> ارسال</button>
                                  <button type="button" onclick="document.getElementById('pay_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-card w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                </div>
                                <br>
                              </form>
                            </div>
                          </div>
                      </div><!-- END pay for reservation  MODAL -->
                    @endforeach
                  </tbody>
                </table>
              </div><!-- END table data -->
          </div><!-- END list -->
      </div>

      <!-- confirmable reservation only -->
      <div id="confirmable" class="w3-container tabs">
         <div class="w3-margin-bottom w3-margin-top">
            <div class="w3-responsive"> <!-- START table data -->
                <table class="w3-table w3-striped w3-margin-bottom">
                    <thead>
                      <tr class="">
                          <th class="">اسم العقار</th>
                          <th class="">بداية الإيجار</th>
                          <th class="">نهاية الإيجار</th>
                          <th class="	"> تاريخ الطلب</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($confirmable_reservations as $reservation)
                        <tr>
                            <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                            <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                            <td>{{ $start_date->format('Y-m-d')  }}</td>
                            <td>{{ $end_date->format('Y-m-d') }}</td>
                            <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- END table data -->
        </div><!-- END list -->
      </div>

      <!-- rejected reservation only -->
      <div id="rejected" class="w3-container tabs">
         <div class="w3-margin-bottom w3-margin-top">
            <div class="w3-responsive"> <!-- START table data -->
                <table class="w3-table w3-striped w3-margin-bottom">
                    <thead>
                      <tr class="">
                          <th class="">اسم العقار</th>
                          <th class="">بداية الإيجار</th>
                          <th class="">نهاية الإيجار</th>
                          <th class="	"> تاريخ الطلب</th>
                          <th class="">العمليات </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($rejected_reservations as $reservation)
                        <tr>
                            <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                            <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                            <td>{{ $start_date->format('Y-m-d')  }}</td>
                            <td>{{ $end_date->format('Y-m-d') }}</td>
                            <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                            <td>
                              <div class="w3-bar">
                                  <button type="button" onclick="document.getElementById('delete_rejected_reservation_{{ $reservation->id }}').style.display='block'" class="w3-btn w3-mobile"><i class="fa fa-times w3-text-gray w3-border" style="padding: 5px;"></i></button>
                              </div>
                            </td>
                          </tr>
                          <!-- START reservation_confirm MODAL -->
                          <div id="delete_rejected_reservation_{{ $reservation->id }}" class="w3-modal">
                            <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                                <header class="w3-container brnda-card">
                                    <span onclick="document.getElementById('delete_rejected_reservation_{{ $reservation->id }}').style.display='none'"
                                      class="w3-btn w3-display-topleft">&times;</span>
                                    <h4>حذف</h4>
                                </header>
                                <form action="{{ route('reservation.index') }}" method="post" id="delete_rejected_reservation_form_{{ $reservation->id }}">
                                    @csrf
                                    <div class="w3-container">
                                        <div class="w3-section">
                                            <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue w3-text-gray"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                                        </div>
                                    </div>

                                    <footer class="w3-container ">
                                        <div class="w3-margin-top w3-margin-bottom w3-left">
                                            <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                                <button form="delete_rejected_reservation_form_{{ $reservation->id }}" name="disable_reserv" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                                <button type="button" onclick="document.getElementById('delete_rejected_reservation_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                            </div>
                                      </footer>
                                    </form>
                                </div>
                            </div><!-- END rejected_confirm MODAL -->
                        @endforeach
                    </tbody>
                </table>
            </div><!-- END table data -->
        </div><!-- END list -->
      </div>

  </div>
</div>

@include('layouts/footer')

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

<script>
  function openTab(evt, TabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("tabs");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
    }
    document.getElementById(TabName).style.display = "block";
    evt.currentTarget.className += " w3-white";
  }
  // Click on the first tablink on load
  document.getElementsByClassName("tablink")[0].click();
</script>

<script>
  function paymentTab(evt, TabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("payment_tabs");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("paymentLink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
    }
    document.getElementById(TabName).style.display = "block";
    evt.currentTarget.className += " w3-white";
  }
  // Click on the first tablink on load
  //document.getElementsByClassName("paymentLink")[0].click();

</script>

</body>
</html>
