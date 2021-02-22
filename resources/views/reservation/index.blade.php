@include('layouts/header')

<!-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> -->

<body class="text-right">
  <div class="w3-white">


  <!-- sidebar menu -->
    @include('layouts/aside')

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- -->

    <br>
    <div class="w3-content  w3-card w3-responsive" dir="rtl">

    <div class="w3-container">
      <h3> طلبات الايجار على عقاراتي </h3>
    </div>

    <div class="w3-bar w3-border-bottom w3-card">
      <button style="cursor: pointer"  class="w3-bar-item tablink w3-hover-border-bottom-brnda" onclick="openTab(event,'all')"><i class="fa fa-plus-square"></i> الطلبات الجديدة</button>
      <button style="cursor: pointer"  class="w3-bar-item w3-hover-border-bottom-brnda tablink" onclick="openTab(event,'accepted')"><i class="fa fa-check-square"></i> الطلبات المقبولة</button>
      <button style="cursor: pointer" class="w3-bar-item w3-hover-border-bottom-brnda tablink" onclick="openTab(event,'confirmable')"><i class="fa fa-check-square"></i> الطلبات المؤكدة</button>
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
                        <th class="">اسم المستأجر</th>
                        <th class="">اسم العقار</th>
                        <th class="">بداية الإيجار</th>
                        <th class="">نهاية الإيجار</th>
                        <th class="	"> تاريخ الطلب</th>
    	                  <th class="">العمليات </th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($reservations as $reservation)
                        <tr>
                            <td><a href="#">{{ $reservation->user->name }}</a></td>
                            <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                            <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                            <td>{{ $start_date->format('Y-m-d')  }}</td>
                            <td>{{ $end_date->format('Y-m-d') }}</td>
                            <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
    			                  <td>
                                <div class="">
                                    <div class="w3-bar">
                                        <button onclick="document.getElementById('accept_reservation_{{ $reservation->id }}').style.display='block'" class=" w3-btn w3-mobile w3-text-gray w3-border" style="padding: 0;"><i class="fa fa-check" style="padding: 5px;"></i></button>
                                        <button type="button" onclick="document.getElementById('delete_reservation_{{ $reservation->id }}').style.display='block'" class="w3-btn w3-mobile"><i class="fa fa-times w3-text-gray w3-border" style="padding: 5px;"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- START reservation_ accept confirm MODAL -->
                        <div id="accept_reservation_{{ $reservation->id }}" class="w3-modal">
                          <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                              <header class="w3-container brnda-card">
                                  <span onclick="document.getElementById('accept_reservation_{{ $reservation->id }}').style.display='none'"
                                    class="w3-btn w3-display-topleft">&times;</span>
                                  <h4>الموافقة على طلب الحجز</h4>
                                  <p>هل انت متأكد من رغبتك في قبول طلب الحجز </p>
                              </header>
                              <form action="{{ route('reservation.index') }}" method="post" id="accept_reservation_form_{{ $reservation->id }}">
                                  @csrf
                                  <footer class="w3-container ">
                                      <div class="w3-margin-top w3-margin-bottom w3-left">
                                          <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                              @if($reservation->status != 1 and $reservation->status != 2)
                                                <button form="accept_reservation_form_{{ $reservation->id }}" name="accept_reserv" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                              @endif
                                              <button type="button" onclick="document.getElementById('accept_reservation_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                          </div>
                                    </footer>
                                  </form>
                              </div>
                          </div><!-- END reservation accepted MODAL -->

                        <!-- START reservation_ delete confirm MODAL -->
                        <div id="delete_reservation_{{ $reservation->id }}" class="w3-modal">
                          <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                              <header class="w3-container brnda-card">
                                  <span onclick="document.getElementById('delete_reservation_{{ $reservation->id }}').style.display='none'"
                                    class="w3-btn w3-display-topleft">&times;</span>
                                  <h4>حذف</h4>
                              </header>
                              <form action="{{ route('reservation.index') }}" method="post" id="delete_reservation_form_{{ $reservation->id }}">
                                  @csrf
                                  <div class="w3-container">
                                      <div class="w3-section">
                                          <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue w3-text-gray"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                                      </div>
                                  </div>

                                  <footer class="w3-container ">
                                      <div class="w3-margin-top w3-margin-bottom w3-left">
                                          <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                              <button form="delete_reservation_form_{{ $reservation->id }}" name="delete_reserv" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                              <button type="button" onclick="document.getElementById('delete_reservation_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                          </div>
                                    </footer>
                                  </form>
                              </div>
                          </div><!-- END reservation_confirm MODAL -->
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
                    <th class="">اسم المستأجر</th>
                    <th class="">اسم العقار</th>
                    <th class="">بداية الإيجار</th>
                    <th class="">نهاية الإيجار</th>
                    <th class="	"> تاريخ الطلب</th>
                     <th class="">العمليات </th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($accepted_reservations as $reservation)
                      <tr>
                          <td><a href="#">{{ $reservation->user->name }}</a></td>
                          <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                          <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                          <td>{{ $start_date->format('Y-m-d')  }}</td>
                          <td>{{ $end_date->format('Y-m-d') }}</td>
                          <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                          <td>
                            <div class="w3-bar">
                                <button type="button" onclick="document.getElementById('delete_accepted_reservation_{{ $reservation->id }}').style.display='block'" class="w3-btn w3-mobile"><i class="fa fa-times w3-text-gray w3-border" style="padding: 5px;"></i></button>
                            </div>
                          </td>
                        </tr>

                        <!-- START reservation_confirm MODAL -->
                        <div id="delete_accepted_reservation_{{ $reservation->id }}" class="w3-modal">
                          <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                              <header class="w3-container brnda-card">
                                  <span onclick="document.getElementById('delete_accepted_reservation_{{ $reservation->id }}').style.display='none'"
                                    class="w3-btn w3-display-topleft">&times;</span>
                                  <h4>حذف</h4>
                              </header>
                              <form action="{{ route('reservation.index') }}" method="post" id="delete_accepted_reservation_form_{{ $reservation->id }}">
                                  @csrf
                                  <div class="w3-container">
                                      <div class="w3-section">
                                          <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue w3-text-gray"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                                      </div>
                                  </div>

                                  <footer class="w3-container ">
                                      <div class="w3-margin-top w3-margin-bottom w3-left">
                                          <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                              <button form="delete_accepted_reservation_form_{{ $reservation->id }}" name="delete_reserv" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                              <button type="button" onclick="document.getElementById('delete_accepted_reservation_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                          </div>
                                    </footer>
                                  </form>
                              </div>
                          </div><!-- END reservation_confirm MODAL -->
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
                            <th class="">اسم المستأجر</th>
                            <th class="">اسم العقار</th>
                            <th class="">بداية الإيجار</th>
                            <th class="">نهاية الإيجار</th>
                            <th class="	"> تاريخ الطلب</th>
                            <th class="">العمليات </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($confirmable_reservations as $reservation)
                          <tr>
                              <td><a href="#">{{ $reservation->user->name }}</a></td>
                              <td><a href="#">{{ $reservation->agar->agar_name }}</a></td>
                              <?php $start_date = new DateTime($reservation->start_date); $end_date = new DateTime($reservation->end_date) ?>
                              <td>{{ $start_date->format('Y-m-d')  }}</td>
                              <td>{{ $end_date->format('Y-m-d') }}</td>
                              <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                              <td>
                                <div class="w3-bar">
                                    <button type="button" onclick="document.getElementById('delete_confirmable_reservation_{{ $reservation->id }}').style.display='block'" class="w3-btn w3-mobile"><i class="fa fa-times w3-text-gray w3-border" style="padding: 5px;"></i></button>
                                </div>
                              </td>
                            </tr>
                            <!-- START reservation_confirm MODAL -->
                            <div id="delete_confirmable_reservation_{{ $reservation->id }}" class="w3-modal">
                              <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:480px">
                                  <header class="w3-container brnda-card">
                                      <span onclick="document.getElementById('delete_confirmable_reservation_{{ $reservation->id }}').style.display='none'"
                                        class="w3-btn w3-display-topleft">&times;</span>
                                      <h4>حذف</h4>
                                  </header>
                                  <form action="{{ route('reservation.index') }}" method="post" id="delete_confirmable_reservation__form_{{ $reservation->id }}">
                                      @csrf
                                      <div class="w3-container">
                                          <div class="w3-section">
                                              <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue w3-text-gray"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                                          </div>
                                      </div>

                                      <footer class="w3-container ">
                                          <div class="w3-margin-top w3-margin-bottom w3-left">
                                              <input type="hidden" value="{{ $reservation->id }}" name="reserv_id" />
                                                  <button form="delete_confirmable_reservation__form_{{ $reservation->id }}" name="delete_reserv" value="موافق"class="w3-btn brnda-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</button>
                                                  <button type="button" onclick="document.getElementById('delete_confirmable_reservation_{{ $reservation->id }}').style.display='none'"class="w3-btn w3-white w3-ripple"><i class="fa fa-arrow-right"></i> إلغاء</button>
                                              </div>
                                        </footer>
                                      </form>
                                  </div>
                              </div><!-- END reservation_confirm MODAL -->
                          @endforeach
                      </tbody>
                  </table>
              </div><!-- END table data -->
          </div><!-- END list -->
        </div>

    </div>
  </div>

  @include('layouts/footer')



  <script src="{{ asset('js/script.js') }}"></script>

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


  </body>
  </html>
