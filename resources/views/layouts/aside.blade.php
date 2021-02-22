<div class="w3-bar w3-large w3-border-bottom" style="z-index:4; height: 100px">
  <span class="w3-bar-item w3-left" style="padding: 20px;">
    <a href="/"><img height="60px" width="60px" src="{{ asset('images/branda_logo.png') }}" alt="شعار برندة" /></a>
  </span>

  <button class="w3-bar-item w3-right w3-button w3-right w3-hover-none w3-hover-text-grey w3-xxlarge" style="padding: 20px" onclick="w3_open();">
    <i class="fa fa-bars"></i>
  </button>

  <div class="w3-bar-item w3-right w3-button w3-hover-none w3-xlarge" style="margin-top: 15px">
    <div id="notification">
      @if(Auth::check())
      <notification-app :user="{{ Auth::user()->id }}"></notification-app>
      @endif
    </div>
   </div>

</div>

<!-- Sidebar/menu -->
<nav dir="rtl" class="w3-sidebar w3-animate-right" style="z-index:3;width:250px;display: none;position: relative; right: 0px" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s4">
            <img src="{{ asset('images/avatar2.png') }}" class="w3-circle w3-margin-right" style="width:46px">
        </div>

        <div class="w3-col s8 w3-bar" dir="auto">
          @if(Auth::check())
            <span class="w3-bar-item w3-right w3-right-align">مرحباُ  <strong>
             {{ Auth::user()->name }}
            </strong></span><br>
          @endif
        </div>
    </div>

    <br>

    <div class="w3-bar-block">
        <a href="javascript::void()" class="w3-bar-item text-right w3-btn w3-padding-16 w3-hide-large1 w3-brnda w3-hover-black"onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  اغلق القائمة</a>

        <a href="{{ route('home') }}" class="w3-bar-item w3-large w3-btn w3-padding text-right">
          <i class="fa fa-home"></i> الرئيسية
        </a>

        <a href="{{ route('agars.agarsList') }}" class="w3-bar-item w3-large text-right w3-btn w3-padding">
          <i class="fa fa-building-o"></i>  العقارات
        </a>

        <a href="{{ route('agars.myAgars') }}" class="w3-bar-item w3-large w3-btn w3-padding text-right w3-animate-zoom">
          <i class="fa fa-hotel"></i>  عقاراتي
        </a>

        <a href="{{ route('reservation.index') }}" class="w3-bar-item w3-large w3-btn w3-padding text-right w3-animate-zoom">
          <i class="fa fa-mail-forward"></i> طلبات الايجار لعقاراتي
        </a>

        <a href="{{ route('reservation.sent') }}" class="w3-bar-item w3-large w3-btn w3-padding text-right w3-animate-zoom">
          <i class="fa fa-mail-reply"></i> طلبات الايجار المرسلة
        </a>

        @if(Auth::check())
        <hr>

        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" name="logout" class="w3-bar-item w3-large w3-btn w3-padding text-right w3-animate-zoom"><i class="fa fa-sign-out"></i> تسجيل خروج </button>
        </form>

        @endif

    </div>
</nav>

<div class="w3-clear"></div>
