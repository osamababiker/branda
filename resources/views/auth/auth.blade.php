
<!DOCTYPE html>
<html>
<head>
    <title> برندة</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dropzone.css') }}" type="text/css">
    <link rel="stylesheet"  href="{{ asset('lib/lightslider-master/src/css/lightslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-windows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/webfonts/FontAwesome.otf') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css'}}" >

    <!-- genral css file -->
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
</head>


<body class="w3-light-gray">

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
           @csrf
             <div id="register">
              <register-app></register-app>
            </div>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
           @csrf
            <div id="login">
              <login-app></login-app>
            </div>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay" >
            <div class="overlay-panel overlay-left">
                <h1> ! مرحباً بك</h1>

                <p>للتواصل معنا سجل الدخول باستخدام معلوماتك الشخصية</p>
                <button class="ghost" id="signIn">تسجيل الدخول</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1> مرحباً بك ، صديقي</h1>
                <p> !ادخل معلوماتك الشخصية وابدأ </p>
                <button class="ghost" id="signUp">تسجيل</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/jQuery.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
