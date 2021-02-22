@include('layouts/header')

<!-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> -->

<body class="text-right">
  <div class="w3-white">


  <!-- sidebar menu -->
    @include('layouts/aside')

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- -->

    <div class="w3-content w3-responsive" dir="rtl">

    <div class="w3-container w3-margin-top">
      <h3> اشعارات الموقع </h3>
      @if($notifications->count())
        <div class="">
          <form action="/notification" method="post">
            @csrf
            <button type="submit" class="w3-color-brnda w3-white" style="border: 0px;cursor: pointer"  name="read_all"> تحديث الكل كمقروء </button>
          </form>
        </div>
      @endif
    </div>


    <div  class="w3-container">
      <div class="w3-margin-bottom w3-margin-top">
       @if($notifications->count())
        @foreach($notifications as $notification)
          <div class="w3-card w3-padding">
            <h4 style="font-weight: bold"> رسالة من {{ App\User::find($notification->from)->name }} </h4>
            <p> {{ $notification->message }} </p>
          </div>
        @endforeach
       @else
        <div class="alert alert-info w3-card w3-padding">
          لا توجد اشعارات جديدة
        </div>
       @endif
      </div><!-- END list -->
    </div>



    </div>
  </div>

  @include('layouts/footer')



  <script src="{{ asset('js/script.js') }}"></script>



  </body>
  </html>
