
<!DOCTYPE html>
<html>
<head>
    <title> برندة</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-windows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/webfonts/FontAwesome.otf') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css')}}" >

    <!-- genral css file -->
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
</head>
<body class="w3-light-gray">

<div class="container sign-container">
  <div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{ route('login') }}">
           @csrf
            <div id="login" class="w3-margin-top">
              <login-app></login-app>
            </div>
        </form>
    </div>

    <div class="col-md-6 w3-signup-brnda signin-brnda">
      <div class="w3-padding">
          <div class="w3-center signin-brnda-content">
              <h1> مرحباً بك ، صديقي</h1>
              <p> لا تمتلك حساب في الموقغ, قم بانشاء حساب جديد </p>
              <a href="/register" class="ghost" id="signUp">انشاء حساب</a>
          </div>
      </div>
    </div>
  </div>
</div>


<script src="{{ asset('js/jQuery.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
