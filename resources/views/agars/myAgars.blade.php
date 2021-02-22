@include('layouts/header')

<!-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> -->

  <body class="text-right">
    <div class="w3-white">


    <!-- sidebar menu -->
      @include('layouts/aside')

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- -->

    <!-- !PAGE CONTENT! -->
    <div class="container" dir="rtl">
        <div class="w3-container w3-margin-top">
            <div class="w3-card-4">
                <header class="w3-bar w3-padding " style="position: relative">
                    <span class="w3-bar-item w3-right"> <h5><strong><i class="fa fa-building-o"></i> &nbsp; عقاراتي</strong></h5></span>
                    <span id="addNewAgar" onclick="document.getElementById('NEW_AGAR_FORM').style.display='block'" class=" w3-large w3-hover-light-gray w3-display-left w3-margin-left w3-white w3-border w3-border-gray w3-round w3-text-gray" style="padding: 7px 15px">
                        <i style="font-weight: 50;" class="fa fa-plus"></i>
                    </span>
                </header>

                <div class="w3-margin">
                    <div id="I_New" class="tab-el" style="display:block">
                        <div class="w3-margin-bottom w3-margin-top">
                            <div class="w3-responsive"> <!-- START table data -->
                                <table class="w3-table w3-striped w3-margin-bottom ">
                                    <thead>
                                    <tr class="w3-card">
                                        <th class="w3-center">#</th>
                                        <th class="w3-center">الإسم</th>
                                        <th class="w3-center">نوع العقار</th>
                                        <th class="w3-center">الطابق</th>
                                        <th class="w3-center">الموقع الجغرافي</th>
                                        <th class="w3-center">عدد الغرف</th>
                                        <th class="w3-center">عدد الحمامات</th>

                                        <th class="w3-center">العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody class="w3-text-dark-grey">
                                      @foreach($agars as $agar)
                                        <tr>
                                            <td>{{ $agar->id }}</td>
                                            <td>
                                              <a class="w3-text-blue" href="{{ route('agars.single',['agar_id' => $agar->id]) }}">
                                                 {{ $agar->agar_name }}
                                              </a>
                                              @if($agar->admin_comments != '' and $agar->status == 3)
                                                <button class="w3-bar-item w3-btn w3-mobile" type="button" onclick="document.getElementById('admin_comments_{{ $agar->id }}').style.display = 'block'"></a>
                                                  <i class="fa fa-bullhorn w3-text-red"></i>
                                                </button>
                                              @endif
                                            </td>
                                            <td>{{ $agar->type->type_name }}</td>
                                            <td>{{ $agar->floor->floor_name }}</td>
                                            <td>
                                              {{ $agar->location->state->state_name  }} /
                                              {{ $agar->location->city->city_name  }} /
                                              {{ $agar->location->area  }}
                                            </td>
                                            <td>{{ $agar->rooms_number }}</td>
                                            <td>{{ $agar->bathrooms_number }}</td>
                                                                                                                                                    </td>
                                            <td>
                                              <div class="w3-center">
                                                @if(Auth::user()->id == $agar->owner_id)
                                                  <div class="w3-bar">
                                                      <a href="{{ route('agar.dashboard',['agar_id' => $agar->id]) }}"
                                                       class="w3-bar-item w3-btn w3-mobile"><i class="fa fa-info"></i></a>
                                                      <a href="javascript::void()" onclick="document.getElementById('edit_agar_{{ $agar->id }}').style.display='block'" class="w3-bar-item w3-btn w3-mobile"><i class="fa fa-edit"></i></a>
                                                      <button type="button" onclick="document.getElementById('delete_agar_confirm_{{ $agar->id }}').style.display='block'"
                                                            class="w3-bar-item w3-btn w3-mobile"><i class="fa fa-trash-o"></i></button>
                                                  </div>
                                                  @else
                                                  <div class="w3-bar">
                                                      <a href="{{ route('agars.single',['agar_id' => $agar->id]) }}"
                                                       class="w3-bar-item w3-btn w3-mobile w3-text-blue"> اعرف اكثر </a>
                                                  </div>
                                                  @endif
                                              </div>
                                            </td>

                                            <!-- edit agar info -->
                                            <div id="edit_agar_{{ $agar->id }}" class="w3-modal" style="display: none">
                                              @include('layouts/editAgar')
                                            </div> <!-- END edit agar info -->

                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div><!-- END table data -->
                        </div><!-- END list -->
                    </div><!-- END New -->
                    <div id="I_Accepted" class="tab-el"
                         style="display:none">
                    </div><!-- END Accepted -->
                    <!-- START Done -->
                    <div id="I_Done" class="tab-el"
                         style="display:none">
                    </div><!-- END Done -->
                    <div id="I_Undone" class="tab-el"
                         style="display:none">
                    </div>
                    <div id="I_Canceled" class="tab-el"
                         style="display:none">
                    </div><!-- END New Canceled -->
                </div>
            </div>
        </div>
        <br>
        <!-- START MODALS -->

        <div id="NEW_AGAR_FORM" class="w3-modal" style="display: none"><!-- START NEW_AGAR_FORM -->
          @include('layouts/addAgar')
        </div> <!-- END NEW_AGAR_FORM -->


    <div><!-- START delete_agar_confirm_ MODALS -->
      @foreach($agars as $agar)
        <div id="delete_agar_confirm_{{ $agar->id }}" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:480px">

                <header class="w3-container w3-border-bottom">
                    <span onclick="document.getElementById('delete_agar_confirm_{{ $agar->id }}').style.display='none'" class="w3-btn w3-display-topleft">&times;</span>
                    <h4>حذف</h4>
                </header>

                <div class="w3-container">
                    <div class="w3-section">
                        <p><i class="fa fa-2x w3-padding fa-trash-o w3-text-flat-midnight-blue"></i><span> هل أنت متأكد من أنك تريد حذف هذا العنصر؟، هذه العملية لا يمكن التراجع عنها.</span></p>
                    </div>
                    <div class="w3-row-padding w3-section">

                        <div class="w3-twothird">
                            <table class="w3-table w3-responsive">
                                <tr>
                                    <th>الإسم</th>
                                    <td>{{ $agar->agar_name }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء</th>
                                    <td>{{ $agar->created_at->diffForHumans() }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <footer class="w3-container">
                    <div class="w3-margin-top w3-margin-bottom w3-right">
                        <form id="delete_agar_form_{{ $agar->id }}" action="{{ route('agars.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="agar_id" value="{{ $agar->id }}"/>
                            <button type="submit" form="delete_agar_form_{{ $agar->id }}" autofocus type="submit" name="delete_agar_btn" value="موافق"
                                class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" style="padding: 7px 15px"><i class="fa fa-check-square"></i> موافق</button>
                            <button type="button" onclick="document.getElementById('delete_agar_confirm_{{ $agar->id }}').style.display='none'"
                                class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" style="padding: 7px 15px"><i class="fa fa-arrow-right"></i> إلغاء</button>
                        </form>
                    </div>
                </footer>
            </div>
        </div><!-- END delete_agar_confirm MODAL -->


        <!-- admin comment in agar model -->
        <div class="w3-modal" id="admin_comments_{{ $agar->id }}">
          <div class="w3-panel w3-modal-content w3-card-4 w3-padding-64 w3-animate-zoom" style="max-width:480px">
            <span onclick="document.getElementById('admin_comments_{{ $agar->id }}').style.display='none'"
            class="w3-button w3-large w3-display-topright">&times;</span>
            <h3 class="w3-center"> {{ $agar->admin_comments }} </h3>
          </div>
        </div>

        @endforeach

    </div><!-- END delete_agar_confirm_ MODALS -->

    @include('layouts/footer')

<!-- End page content -->
</div>


<script>
    function opent(evt, Name) {
        var i, x, tablinks;
        x = document.getElementsByClassName("tab-el");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
        }
        document.getElementById(Name).style.display = "block";
        evt.currentTarget.className += " w3-blue";
    }
</script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
